<?php
// กำหนดชุดคำถามแบ่งตามหมวดหมู่
$assessments = [
    "วิชาชีพ (Hard Skills)" => [
        "การจัดการทรัพยากร: สามารถวิเคราะห์หมวดหมู่ (DDC, LC, NLM) และลงรายการ (MARC21, RDA) ของทรัพยากรตีพิมพ์ได้",
        "การจัดหาและพัฒนาทรัพยากร: เข้าใจกระบวนการคัดเลือก สั่งซื้อ และประเมินคุณภาพหนังสือหรือสื่อสิ่งพิมพ์",
        "ระบบห้องสมุดอัตโนมัติ: ใช้งานโมดูลพื้นฐาน (เช่น งานยืม-คืน, การจัดการสมาชิก) ในระบบห้องสมุด (ALS) ได้อย่างคล่องแคล่ว",
        "การสืบค้นขั้นสูง: ใช้เทคนิคสืบค้น (Boolean, Proximity) เพื่อดึงข้อมูลจากฐานข้อมูลวิชาการออนไลน์ได้อย่างแม่นยำ",
        "การจัดการข้อมูลดิจิทัล: เข้าใจการทำ Metadata (เช่น Dublin Core) และการสร้างคลังข้อมูลดิจิทัล (Institutional Repository)",
        "การประยุกต์ใช้เทคโนโลยี: สามารถใช้เครื่องมือทาง IT, Data Analytics หรือ AI เพื่อจัดการและสรุปผลสารสนเทศได้"
    ],
    "อารมณ์และบริการ (Soft Skills)" => [
        "จิตบริการ (Service Mind): เต็มใจให้บริการหน้าเคาน์เตอร์ ช่วยเหลือผู้ใช้ห้องสมุดในการหาหนังสือด้วยความสุภาพ",
        "ความละเอียดในการจัดการพื้นที่: ใส่ใจสภาพหนังสือ การจัดเรียงขึ้นชั้นให้ถูกต้อง และดูแลบรรยากาศห้องสมุดให้น่านั่ง",
        "การส่งเสริมการอ่าน: มีความคิดสร้างสรรค์ในการจัดนิทรรศการ หรือกิจกรรมเพื่อดึงดูดให้คนเข้ามาใช้ห้องสมุด",
        "การประเมินความน่าเชื่อถือ: มีวิจารณญาณในการตรวจสอบแหล่งที่มา ความถูกต้อง และความทันสมัยของข้อมูลดิจิทัล",
        "การปรับตัวกับเทคโนโลยี: เปิดรับและพร้อมเรียนรู้โปรแกรม ระบบฐานข้อมูล หรือซอฟต์แวร์ใหม่ๆ อยู่เสมอ",
        "การคำนึงถึงผู้ใช้งาน (UX Mindset): มักจะคิดถึงความสะดวกของผู้ใช้งานเป็นหลักเมื่อต้องออกแบบระบบจัดเก็บหรือบริการข้อมูล"
    ],
    "ทำงานเป็นทีม (Teamwork)" => [
        "การร่วมมือหน้างาน: พร้อมช่วยเหลือเพื่อนร่วมงานในการจัดชั้นหนังสือ สำรวจทรัพยากร (Stocktaking) หรืองานบริการที่เร่งด่วน",
        "การประสานงานกิจกรรม: สามารถทำงานร่วมกับฝ่ายอื่นๆ เพื่อจัดกิจกรรมห้องสมุดสัญจร หรืองานสัปดาห์หนังสือได้อย่างราบรื่น",
        "ความยืดหยุ่นในหน้าที่: ยินดีสลับหน้าที่ระหว่างงานเบื้องหน้า (บริการ) และงานเบื้องหลัง (จัดการหนังสือ) เมื่อทีมต้องการ",
        "การทำงานร่วมบนระบบ: สามารถทำงานร่วมกับผู้อื่นในระบบฐานข้อมูลเดียวกันได้โดยไม่ทำให้ข้อมูลของส่วนรวมเสียหาย",
        "การแบ่งปันความรู้ทางเทคนิค: ยินดีให้คำแนะนำหรือช่วยแก้ปัญหาด้านไอทีและระบบเบื้องต้นให้กับเพื่อนร่วมทีม",
        "การเคารพข้อตกลงข้อมูล: ปฏิบัติตามมาตรฐานการลงข้อมูล (Data Standard) ที่ทีมตกลงไว้อย่างเคร่งครัดเพื่อให้ระบบเป็นระเบียบ"
    ],
    "ความรับผิดชอบ (Responsibility)" => [
        "การดูแลทรัพย์สิน: มีความรับผิดชอบในการดูแลรักษาหนังสือ สื่อสิ่งพิมพ์ และอุปกรณ์ในห้องสมุดไม่ให้ชำรุดหรือสูญหาย",
        "จรรยาบรรณวิชาชีพ: เคารพสิทธิความเป็นส่วนตัวของผู้ใช้บริการ โดยไม่เปิดเผยประวัติการยืม-คืนให้ผู้อื่นทราบ",
        "ความตรงต่อเวลา: รับผิดชอบตารางเวรบริการหน้าเคาน์เตอร์อย่างเคร่งครัด และไม่ละทิ้งหน้าที่",
        "ความปลอดภัยของข้อมูล: รักษารหัสผ่านและข้อมูลที่เป็นความลับขององค์กร และไม่นำข้อมูลส่วนบุคคลไปเผยแพร่ (PDPA)",
        "จริยธรรมสารสนเทศ: เคารพในทรัพย์สินทางปัญญา ลิขสิทธิ์ และรู้จักการอ้างอิงแหล่งที่มาของข้อมูล (Citation) อย่างถูกต้อง",
        "การดูแลระบบข้อมูล: กล้ายอมรับความผิดพลาดหากบันทึกข้อมูลดิจิทัลผิด และรีบดำเนินการแก้ไขในระบบทันที"
    ],
    "การสื่อสาร (Communication)" => [
        "การสัมภาษณ์ผู้ใช้ (Reference Interview): สามารถตั้งคำถามพูดคุยเพื่อเจาะลึกถึงความต้องการหนังสือหรือข้อมูลของผู้ใช้ได้อย่างตรงจุด",
        "การอธิบายกฎระเบียบ: สามารถแจ้งเตือนผู้ใช้บริการ (เช่น ส่งเสียงดัง, คืนหนังสือช้า) ได้อย่างประนีประนอมและสุภาพ",
        "สื่อประชาสัมพันธ์กายภาพ: สามารถออกแบบป้ายประกาศ ป้ายบอกทาง หรือคู่มือการใช้ห้องสมุดที่อ่านง่ายและชัดเจน",
        "การจัดทำคู่มือดิจิทัล: สามารถเขียนอธิบายขั้นตอนการใช้ฐานข้อมูล หรือระบบ OPAC ให้ผู้ใช้ทำตามได้ง่ายๆ",
        "การสื่อสารเรื่องเทคนิค: สามารถอธิบายปัญหาของระบบหรือเทคโนโลยีที่ซับซ้อนให้เพื่อนร่วมงานทั่วไปเข้าใจได้",
        "การจัดการสื่อออนไลน์: สามารถใช้ช่องทางโซเชียลมีเดีย หรืออีเมล เพื่อตอบคำถามและกระจายข่าวสารสนเทศได้อย่างมืออาชีพ"
    ]
];

$scale_options = [
    1 => "น้อยมาก",
    2 => "น้อย",
    3 => "ปานกลาง",
    4 => "บ่อย",
    5 => "ทุกครั้ง"
];

$is_submitted = $_SERVER["REQUEST_METHOD"] == "POST";
$total_score = 0;
$max_score_per_cat = 30;
$max_total_score = $max_score_per_cat * 5;

$category_scores = [
    "วิชาชีพ (Hard Skills)" => 0,
    "อารมณ์และบริการ (Soft Skills)" => 0,
    "ทำงานเป็นทีม (Teamwork)" => 0,
    "ความรับผิดชอบ (Responsibility)" => 0,
    "การสื่อสาร (Communication)" => 0
];

if ($is_submitted) {
    $q_number = 1;
    foreach ($assessments as $cat_key => $questions) {
        foreach ($questions as $q) {
            if (isset($_POST['q_' . $q_number])) {
                $score = intval($_POST['q_' . $q_number]);
                $category_scores[$cat_key] += $score;
                $total_score += $score;
            }
            $q_number++;
        }
    }
    
    // ดึงทักษะอันดับ 1 และอันดับ 2 มาผสมกัน
    $sorted_scores = $category_scores;
    arsort($sorted_scores);
    $keys = array_keys($sorted_scores);
    $top1 = $keys[0];
    $top2 = $keys[1];
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบประเมินความพร้อมก่อนฝึกงาน (บรรณารักษ์และสารสนเทศ)</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #0d9488; /* Teal */
            --primary-hover: #0f766e;
            --bg-color: #f0fdfa;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --tag-bg: #f1f5f9;
            --tag-text: #475569;
            /* สีสเปกตรัมสำหรับตัวเลือกสเกล */
            --color-1: #dc2626; /* แดง */
            --color-2: #f97316; /* ส้ม */
            --color-3: #f59e0b; /* เหลือง/ส้ม */
            --color-4: #84cc16; /* เขียวอ่อน */
            --color-5: #16a34a; /* เขียวเข้ม */
        }
        
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 950px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.9rem;
        }

        .description {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .category-title {
            background-color: #f1f5f9;
            color: #334155;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 35px;
            margin-bottom: 20px;
            font-size: 1.25rem;
            font-weight: 600;
            border-left: 6px solid var(--primary-color);
        }

        .question-block {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .question-text {
            font-weight: 500;
            margin-bottom: 12px;
            font-size: 1.05rem;
        }

        /* ปรับกลุ่มตัวเลือกสเกลให้อยู่ตรงกลาง */
        .radio-group {
            display: flex;
            justify-content: center; /* จัดกลุ่มให้อยู่ตรงกลาง */
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        /* สีสเปกตรัมสำหรับตัวเลือกสเกล */
        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        /* กำหนดสีตามระดับคะแนน */
        .radio-label.level-1 { border-color: var(--color-1); color: var(--color-1); }
        .radio-label.level-1:hover { background-color: #fef2f2; }
        .radio-label.level-1 input[type="radio"] { accent-color: var(--color-1); }

        .radio-label.level-2 { border-color: var(--color-2); color: var(--color-2); }
        .radio-label.level-2:hover { background-color: #fff7ed; }
        .radio-label.level-2 input[type="radio"] { accent-color: var(--color-2); }

        .radio-label.level-3 { border-color: var(--color-3); color: var(--color-3); }
        .radio-label.level-3:hover { background-color: #fffbeb; }
        .radio-label.level-3 input[type="radio"] { accent-color: var(--color-3); }

        .radio-label.level-4 { border-color: var(--color-4); color: var(--color-4); }
        .radio-label.level-4:hover { background-color: #f7fee7; }
        .radio-label.level-4 input[type="radio"] { accent-color: var(--color-4); }

        .radio-label.level-5 { border-color: var(--color-5); color: var(--color-5); }
        .radio-label.level-5:hover { background-color: #f0fdf4; }
        .radio-label.level-5 input[type="radio"] { accent-color: var(--color-5); }


        .radio-label input[type="radio"] {
            margin-right: 8px;
            transform: scale(1.2);
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            font-size: 1.2rem;
            font-family: 'Sarabun', sans-serif;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 40px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .result-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .chart-box {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .summary-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #f8fafc;
            border: 2px solid #94a3b8;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
        }

        .score-display {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 10px 0;
        }

        /* ส่วนคำแนะนำแบบเรียลไทม์ */
        .recommendation-box {
            background: #f0fdf4;
            border: 2px solid #22c55e;
            border-radius: 12px;
            padding: 25px;
            margin-top: 20px;
        }
        
        .recommendation-box h3 {
            color: #15803d;
            margin-top: 0;
        }

        @media (max-width: 768px) {
            .result-container {
                grid-template-columns: 1fr;
            }
            .radio-group {
                flex-direction: column;
                gap: 8px;
                justify-content: flex-start;
            }
            .radio-label {
                width: 100%;
                box-sizing: border-box;
            }
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>แบบประเมินทักษะและความพร้อมก่อนฝึกงาน</h1>
    <div class="description">สาขาวิชาสารสนเทศศึกษา (บรรณารักษ์และสารสนเทศ)</div>

    <?php if ($is_submitted): ?>
        <div class="result-container">
            <div class="chart-box">
                <h3 style="text-align: center; margin-top: 0; color: #334155;">แผนภาพศักยภาพ 5 มิติ</h3>
                <canvas id="skillRadarChart"></canvas>
            </div>

            <div class="summary-box">
                <h2 style="margin:0; color:#334155;">คะแนนรวมของคุณ</h2>
                <div class="score-display"><?php echo $total_score; ?> <span style="font-size: 1.5rem; color:#64748b;">/ <?php echo $max_total_score; ?></span></div>
                <p style="color:#475569; font-weight:500;">
                    <?php
                        if ($total_score >= 125) {
                            echo "🌟 <strong>เกรด A+ (พร้อมลุยงานจริง):</strong> ทักษะของคุณโดดเด่นและสมดุลมาก คุณคือว่าที่ดาวรุ่งในสถานที่ฝึกงาน!";
                        } elseif ($total_score >= 100) {
                            echo "✅ <strong>เกรด B (พร้อมฝึกประสบการณ์):</strong> มีพื้นฐานที่แข็งแรง พร้อมรับมือกับความท้าทายใหม่ๆ ในที่ทำงาน";
                        } elseif ($total_score >= 75) {
                            echo "👍 <strong>เกรด C (กำลังพัฒนา):</strong> มีศักยภาพ แต่ควรใช้กราฟด้านซ้ายดูว่ามีจุดไหนที่เติมเต็มได้อีกก่อนลงสนามจริง";
                        } else {
                            echo "💪 <strong>เกรด D (ต้องเตรียมตัวเพิ่ม):</strong> ไม่ต้องกังวล! ทบทวนพื้นฐานอีกนิดและเปิดใจเรียนรู้ คุณจะทำได้ดีแน่นอน";
                        }
                    ?>
                </p>
            </div>
        </div>

        <div class="recommendation-box">
            <h3>วิเคราะห์บุคลิกและแนวทางการฝึกงานของคุณ</h3>
            <p>จากการประมวลผลทักษะผสมผสาน คุณมีความโดดเด่นในด้าน <strong><?php echo $top1; ?></strong> ควบคู่ไปกับ <strong><?php echo $top2; ?></strong> ซึ่งบ่งบอกว่าคุณมีคาแรคเตอร์การทำงานดังนี้:</p>
            
            <div style="background: #fff; padding: 15px; border-radius: 8px; border: 1px dashed #22c55e; margin-top: 15px;">
                <ul style="color: #166534; line-height: 1.8; margin: 0; padding-left: 20px;">
                    <?php
                        // ระบบจำลอง AI: วิเคราะห์จากการจับคู่ของ 2 ทักษะที่สูงที่สุด
                        $combo = [$top1, $top2];

                        if (in_array("วิชาชีพ (Hard Skills)", $combo) && in_array("การสื่อสาร (Communication)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'Tech-Savvy Communicator'</strong> (สายเทคนิคที่คุยรู้เรื่อง)</li>";
                            echo "<li>คุณเก่งทั้งระบบข้อมูลและการถ่ายทอดความรู้ เหมาะมากกับการเป็น <strong>Digital Reference Librarian</strong> หรือ <strong>Information Literacy Instructor</strong> ที่ต้องสอนหรือทำคู่มือการใช้ฐานข้อมูลให้คนทั่วไปเข้าใจง่าย</li>";
                        
                        } elseif (in_array("วิชาชีพ (Hard Skills)", $combo) && in_array("ความรับผิดชอบ (Responsibility)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'The System Guardian'</strong> (ผู้พิทักษ์ความเป๊ะของระบบ)</li>";
                            echo "<li>คุณมีความแม่นยำและรอบคอบสูงมาก เหมาะกับงานหลังบ้าน (Back-Office) เช่น <strong>Cataloger / Metadata Specialist</strong> หรือ <strong>Archivist (นักจดหมายเหตุ)</strong> ที่ระบบและมาตรฐานข้อมูลผิดพลาดไม่ได้เลย</li>";

                        } elseif (in_array("วิชาชีพ (Hard Skills)", $combo) && in_array("ทำงานเป็นทีม (Teamwork)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'Tech Support Hero'</strong> (ที่พึ่งพาด้านระบบของทีม)</li>";
                            echo "<li>คุณมีทักษะวิชาชีพแน่นและยังเข้ากับทีมได้ดี เหมาะกับการฝึกงานตำแหน่ง <strong>System Librarian</strong> หรือ <strong>Database Manager</strong> ที่ต้องคอยซัพพอร์ตระบบให้แผนกอื่นๆ ทำงานได้อย่างราบรื่น</li>";

                        } elseif (in_array("อารมณ์และบริการ (Soft Skills)", $combo) && in_array("การสื่อสาร (Communication)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'The Empathic Guide'</strong> (นักบริการผู้เข้าใจ)</li>";
                            echo "<li>คุณเกิดมาเพื่ออยู่หน้าฟรอนต์! ด้วยจิตบริการและการสื่อสารที่เป็นเลิศ เหมาะกับงาน <strong>Reference Librarian (บริการตอบคำถามและช่วยการค้นคว้า)</strong> หรือ <strong>UX/Customer Service ในศูนย์สารสนเทศ</strong></li>";

                        } elseif (in_array("อารมณ์และบริการ (Soft Skills)", $combo) && in_array("ทำงานเป็นทีม (Teamwork)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'The Connector'</strong> (กาวใจขององค์กร)</li>";
                            echo "<li>คุณเก่งเรื่องคนและการประสานงาน เหมาะกับการทำงานด้าน <strong>กิจกรรมส่งเสริมการอ่าน (Outreach Librarian)</strong> หรือ <strong>Knowledge Management (KM)</strong> ที่ต้องดึงเอาความร่วมมือจากหลายๆ ฝ่าย</li>";

                        } elseif (in_array("ความรับผิดชอบ (Responsibility)", $combo) && in_array("ทำงานเป็นทีม (Teamwork)", $combo)) {
                            echo "<li><strong>คาแรคเตอร์: 'The Reliable Coordinator'</strong> (ผู้ประสานงานที่ไว้ใจได้)</li>";
                            echo "<li>คุณมีความรับผิดชอบสูงและเห็นแก่ส่วนรวม เหมาะกับงาน <strong>Acquisitions (งานจัดหาและพัฒนาทรัพยากร)</strong> หรือโปรเจกต์พิเศษที่ต้องใช้ความละเอียดในการประสานงานกับสำนักพิมพ์และคนในทีม</li>";

                        } else {
                            // กรณีผสมรูปแบบอื่นๆ (Generalist)
                            echo "<li><strong>คาแรคเตอร์: 'The Adaptive Generalist'</strong> (สายสมดุลและยืดหยุ่น)</li>";
                            echo "<li>คุณมีทักษะที่หลากหลายผสมผสานกันอย่างลงตัว ถือเป็นข้อได้เปรียบที่ทำให้คุณฝึกงานได้แบบ <strong>Job Rotation</strong> (หมุนเวียนทุกแผนก) ไม่ว่าจะเป็นงานบริการหน้าเคาน์เตอร์ หรืองานจัดการสารสนเทศหลังบ้าน คุณก็รับมือได้สบาย!</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="" style="display: inline-block; padding: 12px 30px; background: var(--primary-color); color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">← ประเมินทักษะอีกครั้ง</a>
        </div>

        <script>
            const ctx = document.getElementById('skillRadarChart').getContext('2d');
            const dataScores = [
                <?php echo $category_scores["วิชาชีพ (Hard Skills)"]; ?>,
                <?php echo $category_scores["อารมณ์และบริการ (Soft Skills)"]; ?>,
                <?php echo $category_scores["ทำงานเป็นทีม (Teamwork)"]; ?>,
                <?php echo $category_scores["ความรับผิดชอบ (Responsibility)"]; ?>,
                <?php echo $category_scores["การสื่อสาร (Communication)"]; ?>
            ];

            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['วิชาชีพ', 'อารมณ์', 'ทำงานทีม', 'รับผิดชอบ', 'การสื่อสาร'],
                    datasets: [{
                        label: 'ระดับทักษะ',
                        data: dataScores,
                        backgroundColor: 'rgba(13, 148, 136, 0.3)', 
                        borderColor: 'rgba(13, 148, 136, 1)',
                        pointBackgroundColor: 'rgba(13, 148, 136, 1)', 
                        pointBorderColor: '#fff',
                        pointRadius: 5, 
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(13, 148, 136, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        r: {
                            angleLines: { display: true },
                            suggestedMin: 0,
                            suggestedMax: 30,
                            ticks: { stepSize: 5, backdropColor: 'transparent' }
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });
        </script>

    <?php else: ?>

        <form method="POST" action="">
            <?php 
            $q_number = 1;
            foreach ($assessments as $category_name => $questions): 
            ?>
                <div class="category-title"><?php echo htmlspecialchars($category_name); ?></div>
                
                <?php foreach ($questions as $question): ?>
                    <div class="question-block">
                        <div class="question-text"><?php echo $q_number . ". " . htmlspecialchars($question); ?></div>
                        <div class="radio-group">
                            <?php foreach ($scale_options as $value => $label): ?>
                                <label class="radio-label level-<?php echo $value; ?>">
                                    <input type="radio" name="q_<?php echo $q_number; ?>" value="<?php echo $value; ?>" required>
                                    <?php echo $label; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php $q_number++; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <button type="submit" class="btn-submit">ประมวลผลการวิเคราะห์</button>
        </form>

    <?php endif; ?>
</div>

</body>
</html>