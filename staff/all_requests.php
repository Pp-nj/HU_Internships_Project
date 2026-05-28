<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/auth.php';
require_role(['teacher', 'staff']);

$role = current_role();
$user = current_user();

// 1. รับค่าสำหรับการค้นหา การเรียงลำดับ และการกรองต่างๆ จาก URL
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort_order = isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'ASC' : 'DESC';
$status_filter = isset($_GET['status']) && $_GET['status'] !== '' ? (int)$_GET['status'] : '';
$teacher_filter = isset($_GET['teacher_id']) && $_GET['teacher_id'] !== '' ? (int)$_GET['teacher_id'] : '';

// 2. ดึงรายชื่ออาจารย์มาแสดงใน Dropdown (เฉพาะ "เจ้าหน้าที่" เท่านั้นที่จะได้เลือก ส่วนอาจารย์จะถูกซ่อนไว้)
$teachers_list = [];
if ($role === 'staff') {
    $t_res = $conn->query("SELECT teacher_id, first_name, last_name FROM teacher ORDER BY first_name");
    if ($t_res) {
        $teachers_list = $t_res->fetch_all(MYSQLI_ASSOC);
    }
}

// 3. เตรียมโครงสร้างคำสั่ง SQL พื้นฐาน (JOIN ตารางนิสิต, บริษัท และอาจารย์)
$query_str = "SELECT r.request_id, r.start_date, r.end_date, r.status_id, r.position AS position_title,
                     s.first_name, s.last_name, s.student_code, c.company_name,
                     t.first_name AS t_fname, t.last_name AS t_lname
              FROM internships_request r
              JOIN student s ON s.student_id = r.student_id
              JOIN company c ON c.company_id = r.company_id
              LEFT JOIN teacher t ON r.advisor_id = t.teacher_id";

$conditions = [];
$params = [];
$types = "";

// 🔒 [จุดสำคัญ!] เช็กสิทธิ์การเข้าถึงข้อมูลตามบทบาท
if ($role === 'teacher') {
    // 1) ถ้าเป็น "อาจารย์" -> บังคับให้เห็นเฉพาะนิสิตที่ตนเองรับผิดชอบเท่านั้น (ดูของคนอื่นไม่ได้เด็ดขาด)
    $conditions[] = "r.advisor_id = ?";
    $params[] = (int)$user['teacher_id'];
    $types .= "i";
} else {
    // 2) ถ้าเป็น "เจ้าหน้าที่" -> หากมีการเลือกกรองตามรายชื่ออาจารย์ใน Dropdown ค่อยใส่เงื่อนไข
    if ($teacher_filter !== '') {
        $conditions[] = "r.advisor_id = ?";
        $params[] = $teacher_filter;
        $types .= "i";
    }
}

// ตัวกรอง: ค้นหาจากรหัสนิสิต
if ($search !== '') {
    $conditions[] = "s.student_code LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}

// ตัวกรอง: คัดกรองตามขั้นตอนสถานะ
if ($status_filter !== '') {
    $conditions[] = "r.status_id = ?";
    $params[] = $status_filter;
    $types .= "i";
}

// นำเงื่อนไขทั้งหมดมาประกอบเข้ากับ SQL
if (!empty($conditions)) {
    $query_str .= " WHERE " . implode(" AND ", $conditions);
}

// เรียงลำดับตามวันที่สร้างคำขอ
$query_str .= " ORDER BY r.created_at " . $sort_order;

// 4. ประมวลผลคำสั่ง SQL
$stmt = $conn->prepare($query_str);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$page_title = 'คำขอทั้งหมดของนิสิต';
require '../includes/header.php';
?>

<h1>
  <i class="fa-solid fa-list me-2" style="color:var(--swu-red)"></i> รวมคำขอทั้งหมดของนิสิต
</h1>
<p class="muted">
    <?php if ($role === 'teacher'): ?>
        ตรวจสอบสถานะ ค้นหารหัสนิสิต และคัดกรองขั้นตอนของนิสิต<strong>ในความดูแลของคุณ</strong>
    <?php else: ?>
        ค้นหารหัสนิสิต จัดเรียงลำดับ และกรองตามอาจารย์/ขั้นตอนทั้งหมดในระบบได้อย่างละเอียด
    <?php endif; ?>
</p>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <form method="GET" action="all_requests.php" style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
        
        <div style="flex: 1; min-width: 180px;">
            <label for="search" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">รหัสนิสิต:</label>
            <input type="text" id="search" name="search" value="<?= h($search) ?>" placeholder="ตัวอย่าง: 6710..." style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
        </div>

        <?php if ($role === 'staff'): ?>
        <div>
            <label for="teacher_id" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">อาจารย์ที่ปรึกษา:</label>
            <select id="teacher_id" name="teacher_id" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; background-color: white;" onchange="this.form.submit()">
                <option value="">-- ทุกท่าน --</option>
                <?php foreach ($teachers_list as $t_item): ?>
                    <option value="<?= $t_item['teacher_id'] ?>" <?= $teacher_filter === (int)$t_item['teacher_id'] ? 'selected' : '' ?>>
                        <?= h($t_item['first_name'] . ' ' . $t_item['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        
        <div>
            <label for="status" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">ขั้นตอน:</label>
            <select id="status" name="status" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; background-color: white;" onchange="this.form.submit()">
                <option value="">-- ทุกขั้นตอน --</option>
                <option value="1" <?= $status_filter === 1 ? 'selected' : '' ?>>รออนุมัติ</option>
                <option value="2" <?= $status_filter === 2 ? 'selected' : '' ?>>อนุมัติแล้ว</option>
                <option value="3" <?= $status_filter === 3 ? 'selected' : '' ?>>ออกใบส่งตัว</option>
                <option value="4" <?= $status_filter === 4 ? 'selected' : '' ?>>เสร็จสิ้น</option>
                <option value="9" <?= $status_filter === 9 ? 'selected' : '' ?>>ยกเลิก/ไม่ผ่าน</option>
            </select>
        </div>
        
        <div>
            <label for="sort" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">เรียงลำดับ:</label>
            <select id="sort" name="sort" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; background-color: white;" onchange="this.form.submit()">
                <option value="newest" <?= $sort_order === 'DESC' ? 'selected' : '' ?>>ล่าสุด -> เก่าสุด</option>
                <option value="oldest" <?= $sort_order === 'ASC' ? 'selected' : '' ?>>เก่าสุด -> ล่าสุด</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-primary" style="padding: 9px 20px; height: 38px;">
                <i class="fas fa-search me-1"></i> ค้นหา
            </button>
            <?php if ($search !== '' || $sort_order !== 'DESC' || $status_filter !== '' || $teacher_filter !== ''): ?>
                <a href="all_requests.php" class="btn btn-secondary" style="padding: 9px 20px; height: 38px; text-decoration: none; display: inline-block; line-height: 20px; box-sizing: border-box; margin-left: 5px;">ล้างตัวกรอง</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card card-table">
    <div class="card-header">
        <h2>
          <i class="fas fa-folder-open me-2" style="margin-right: 10px;"></i> 
          <?= $role === 'teacher' ? 'รายการคำขอของนิสิตในความดูแลพบทั้งหมด' : 'พบข้อมูลทั้งหมดในระบบ' ?> 
          <span style="font-weight: bold;"><?= count($requests) ?></span> รายการ
        </h2>
        <a class="btn btn-secondary" href="dashboard.php">
          <i class="fas fa-arrow-left me-1" style="margin-right: 10px;"></i>กลับหน้าหลัก
        </a>
    </div>

    <?php if (!$requests): ?>
        <p class="muted" style="padding: 30px; text-align: center;">❌ ไม่พบข้อมูลนิสิตหรือคำขอตามเงื่อนไขที่เลือก</p>
    <?php else: ?>
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>นิสิต</th>
                    <th>บริษัท</th>
                    <th>ช่วง</th>
                    <th>อาจารย์ที่ปรึกษา</th>
                    <th>สถานะ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $r): [$l, $c] = status_label($r['status_id']); ?>
                <tr>
                    <td>#<?= (int)$r['request_id'] ?></td>
                    <td><strong><?= h($r['student_code']) ?></strong><br><?= h($r['first_name'].' '.$r['last_name']) ?></td>
                    <td><?= h($r['company_name']) ?></td>
                    <td><?= h($r['start_date']) ?> → <?= h($r['end_date']) ?></td>
                    <td><?= h($r['t_fname'].' '.$r['t_lname']) ?></td>
                    <td>
                      <span class="badge <?= h($c) ?>"><?= h($l) ?></span>
                    </td>
                    <td>
                        <?php if ($role === 'teacher'): ?>
                          <a href="approve_requests.php?id=<?= (int)$r['request_id'] ?>">จัดการ</a>
                        <?php else: ?>
                          <a href="issue_letter.php?id=<?= (int)$r['request_id'] ?>">จัดการ</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>