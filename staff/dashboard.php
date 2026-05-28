<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/auth.php';
require_role(['teacher','staff']);

$role = current_role();
$user = current_user();

// 🛑 [เพิ่มเข้ามาใหม่] ระบบจัดการการยกเลิกคำขอด่วนจากหน้าแรก (เฉพาะเจ้าหน้าที่ Staff เท่านั้น)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cancel_request') {
    if ($role === 'staff') {
        $cancel_id = (int)$_POST['cancel_id'];
        
        // อัปเดตสถานะในฐานข้อมูลเป็น 9 (ยกเลิก/ไม่ผ่าน)
        $stmt_cancel = $conn->prepare("UPDATE internships_request SET status_id = 9 WHERE request_id = ?");
        $stmt_cancel->bind_param("i", $cancel_id);
        $stmt_cancel->execute();
        $stmt_cancel->close();
        
        // รีเฟรชหน้าตัวเองเพื่ออัปเดตสถิติและสถานะล่าสุดทันที
        header("Location: dashboard.php");
        exit;
    }
}

// 1. เตรียมตัวแปรสำหรับเก็บค่าสถิติ (ค่าเริ่มต้นเป็น 0 ทุกสถานะ)
$by_status = array_fill_keys([1,2,3,4,9], 0);

if ($role === 'teacher') {
    $tid = (int)$user['teacher_id'];

    // --- ดึงจำนวนสถิติ (กรองเฉพาะของอาจารย์ท่านนี้ เพื่อให้ตัวเลขสัมพันธ์กับรายการ) ---
    $stmt_count = $conn->prepare(
        'SELECT status_id, COUNT(*) AS n 
         FROM internships_request 
         WHERE advisor_id = ? 
         GROUP BY status_id'
    );
    $stmt_count->bind_param('i', $tid);
    $stmt_count->execute();
    $counts = $stmt_count->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_count->close();

    // --- ดึงรายการคำขอล่าสุด 20 รายการ ของอาจารย์ท่านนี้ (พร้อม JOIN ดึงชื่ออาจารย์) ---
    $stmt = $conn->prepare(
        'SELECT r.request_id, r.start_date, r.end_date, r.status_id, r.position AS position_title,
                s.first_name, s.last_name, s.student_code, c.company_name,
                t.first_name AS t_fname, t.last_name AS t_lname
         FROM internships_request r
         JOIN student s ON s.student_id = r.student_id
         JOIN company c ON c.company_id = r.company_id
         LEFT JOIN teacher t ON r.advisor_id = t.teacher_id
         WHERE r.advisor_id = ?
         ORDER BY r.created_at DESC LIMIT 20'
    );
    $stmt->bind_param('i', $tid);

} else {
    // --- ดึงจำนวนสถิติ (เจ้าหน้าที่เห็นข้อมูลทั้งหมดในระบบ) ---
    $counts = $conn->query(
        'SELECT status_id, COUNT(*) AS n 
         FROM internships_request 
         GROUP BY status_id'
    )->fetch_all(MYSQLI_ASSOC);

    // --- ดึงรายการคำขอล่าสุด 20 รายการ ทั้งหมดในระบบ (พร้อม JOIN ดึงชื่ออาจารย์) ---
    $stmt = $conn->prepare(
        'SELECT r.request_id, r.start_date, r.end_date, r.status_id, r.position AS position_title,
                s.first_name, s.last_name, s.student_code, c.company_name,
                t.first_name AS t_fname, t.last_name AS t_lname
         FROM internships_request r
         JOIN student s ON s.student_id = r.student_id
         JOIN company c ON c.company_id = r.company_id
         LEFT JOIN teacher t ON r.advisor_id = t.teacher_id
         ORDER BY r.created_at DESC LIMIT 20'
    );
}

// นำผลลัพธ์จากการ Query สถิติมาใส่ใน Array $by_status
foreach ($counts as $c) {
    $by_status[(int)$c['status_id']] = (int)$c['n'];
}

// รันคำสั่งดึงรายการคำขอล่าสุด
$stmt->execute();
$recent = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$page_title = 'หน้าหลัก';
require '../includes/header.php';
?>

<h1>
  <i class="fa-solid fa-address-card me-2" style="color:var(--swu-red)"></i> สวัสดี <?= h($user['display_name']) ?>
</h1>
<p class="muted">
    บทบาท: <?= $role === 'teacher' ? 'อาจารย์' : 'เจ้าหน้าที่' ?>
    <?php if ($role === 'teacher' && !empty($user['department'])): ?>
        · <?= h($user['department']) ?>
    <?php elseif ($role === 'staff' && !empty($user['position'])): ?>
        · <?= h($user['position']) ?>
    <?php endif; ?>
</p>

<div class="stats">
    <div class="stat-card">
        <div class="num"><?= $by_status[1] ?></div>
        <div>รออนุมัติ</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $by_status[2] ?></div>
        <div>อนุมัติแล้ว</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $by_status[3] ?></div>
        <div>ออกใบส่งตัว</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $by_status[4] ?></div>
        <div>เสร็จสิ้น</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $by_status[9] ?></div>
        <div>ยกเลิก/ไม่ผ่าน</div>
    </div>
</div>

<div class="card card-table">
    <div class="card-header">
        <h2>
          <i class="fas fa-clock me-2" style="margin-right: 10px;"></i>คำขอล่าสุด
        </h2>
        <div style="display: flex; gap: 10px;">
            <?php if ($role === 'teacher'): ?>
                <a class="btn btn-primary" href="approve_requests.php">
                  <i class="fas fa-check-circle me-1" style="margin-right: 10px;"></i>ไปอนุมัติคำขอ
                </a>
                <a class="btn btn-secondary" href="supervision.php">
                    <i class="fas fa-clipboard-check me-1" style="margin-right: 10px;"></i>ดูรายการบันทึกนิเทศ
                </a>
            <?php else: ?>
                <a class="btn btn-primary" href="issue_letter.php">
                  <i class="fas fa-envelope-open-text me-1" style="margin-right: 10px;"></i>ออกใบส่งตัว
                </a>
                <a class="btn btn-secondary" href="supervision.php">
                  <i class="fas fa-clipboard-check me-1" style="margin-right: 10px;"></i>ดูรายการบันทึกนิเทศ
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!$recent): ?>
        <p class="muted">ยังไม่มีคำขอ</p>
    <?php else: ?>
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>นิสิต</th>
                    <th>บริษัท</th>
                    <th>ช่วง</th>
                    <th>อาจารย์</th> 
                    <th>สถานะ</th>
                    <th>การจัดการ</th> </tr>
            </thead>
            <tbody>
                <?php foreach ($recent as $r): [$l,$c] = status_label($r['status_id']); ?>
                <tr>
                    <td>#<?= (int)$r['request_id'] ?></td>
                    <td><strong><?= h($r['student_code']) ?></strong><br><?= h($r['first_name'].' '.$r['last_name']) ?></td>
                    <td><?= h($r['company_name']) ?></td>
                    <td><?= h($r['start_date']) ?> → <?= h($r['end_date']) ?></td>
                    <td><?= (!empty($r['t_fname'])) ? h($r['t_fname'].' '.$r['t_lname']) : '<span class="muted">-</span>' ?></td> 
                    <td>
                      <span class="badge <?= h($c) ?>"><?= h($l) ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <?php if ($role === 'teacher'): ?>
                              <a href="approve_requests.php?id=<?= (int)$r['request_id'] ?>">จัดการ</a>
                            <?php else: ?>
                              <a href="issue_letter.php?id=<?= (int)$r['request_id'] ?>">จัดการ</a>
                              
                              <?php if ((int)$r['status_id'] !== 9): ?>
                                  <form method="POST" action="dashboard.php" onsubmit="return confirm('คุณแน่ใจใช่ไหมที่จะยกเลิกคำขอของด่วนนี้? \nข้อมูลจะถูกปรับเป็นสถานะ [ยกเลิก/ไม่ผ่าน] ทันที');" style="margin: 0; display: inline;">
                                      <input type="hidden" name="action" value="cancel_request">
                                      <input type="hidden" name="cancel_id" value="<?= (int)$r['request_id'] ?>">
                                      <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; text-decoration: underline; padding: 0; font-size: inherit; font-family: inherit;">
                                          ยกเลิก
                                      </button>
                                  </form>
                              <?php endif; ?>
                              
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>