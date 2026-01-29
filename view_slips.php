<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💝 รายการสลิปโอนเงิน - Wedding Gift</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(135deg, #1e2a38 0%, #2c3e50 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 40px 20px;
            color: white;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.8;
            font-weight: 300;
        }

        .stats-bar {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            text-align: center;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: #d4af37;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .slips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .slip-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .slip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .slip-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .slip-image:hover {
            opacity: 0.9;
        }

        .slip-info {
            padding: 20px;
        }

        .slip-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e2a38;
            margin-bottom: 5px;
        }

        .slip-amount {
            font-size: 1.5rem;
            color: #d4af37;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .slip-message {
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            margin-bottom: 10px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .slip-date {
            font-size: 0.8rem;
            color: #999;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .no-slips {
            text-align: center;
            padding: 60px 20px;
            color: white;
        }

        .no-slips i {
            font-size: 4rem;
            opacity: 0.3;
            margin-bottom: 20px;
        }

        .no-slips p {
            font-size: 1.2rem;
            opacity: 0.7;
        }

        .back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #d4af37;
            color: white;
            padding: 15px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
        }

        /* Lightbox */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            cursor: pointer;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.5);
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 2rem;
            color: white;
            cursor: pointer;
        }

        /* Loading */
        .loading {
            text-align: center;
            padding: 60px;
            color: white;
        }

        .loading i {
            font-size: 3rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Password Protection */
        .password-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e2a38 0%, #2c3e50 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .password-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .password-box h2 {
            color: #1e2a38;
            margin-bottom: 10px;
        }

        .password-box p {
            color: #666;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .password-box input {
            width: 100%;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .password-box input:focus {
            outline: none;
            border-color: #d4af37;
        }

        .password-box button {
            width: 100%;
            padding: 15px;
            background: #d4af37;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .password-box button:hover {
            background: #c9a030;
        }

        .password-error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 10px;
            display: none;
        }

        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.5rem;
            }

            .stat-card {
                padding: 15px 20px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .slips-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Password Protection -->
    <div id="passwordOverlay" class="password-overlay">
        <div class="password-box">
            <h2>🔒 หน้าสำหรับบ่าวสาว</h2>
            <p>กรุณาใส่รหัสผ่านเพื่อดูรายการสลิปโอนเงิน</p>
            <input type="password" id="passwordInput" placeholder="รหัสผ่าน" onkeypress="if(event.key==='Enter')checkPassword()">
            <button onclick="checkPassword()">เข้าสู่ระบบ</button>
            <p id="passwordError" class="password-error">รหัสผ่านไม่ถูกต้อง</p>
        </div>
    </div>

    <div id="mainContent" style="display: none;">
        <div class="container">
            <div class="header">
                <h1>💝 รายการของขวัญงานแต่ง</h1>
                <p>Jame & May Wedding - 7 มีนาคม 2569</p>
            </div>

            <div class="stats-bar">
                <div class="stat-card">
                    <div class="stat-number" id="totalSlips">0</div>
                    <div class="stat-label">สลิปทั้งหมด</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="totalAmount">฿0</div>
                    <div class="stat-label">ยอดรวม (ประมาณ)</div>
                </div>
            </div>

            <div id="slipsContainer">
                <div class="loading">
                    <i class="fas fa-spinner"></i>
                    <p>กำลังโหลด...</p>
                </div>
            </div>
        </div>

        <a href="index.html" class="back-btn">
            <i class="fas fa-arrow-left"></i> กลับหน้าหลัก
        </a>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <img id="lightboxImg" src="" alt="Slip">
    </div>

    <script>
        // รหัสผ่านง่ายๆ (เปลี่ยนได้ตามต้องการ)
        const ADMIN_PASSWORD = "jamemay2569";

        function checkPassword() {
            const input = document.getElementById('passwordInput').value;
            const error = document.getElementById('passwordError');

            if (input === ADMIN_PASSWORD) {
                document.getElementById('passwordOverlay').style.display = 'none';
                document.getElementById('mainContent').style.display = 'block';
                sessionStorage.setItem('slips_auth', 'true');
                loadSlips();
            } else {
                error.style.display = 'block';
                document.getElementById('passwordInput').value = '';
            }
        }

        // ตรวจสอบ session
        if (sessionStorage.getItem('slips_auth') === 'true') {
            document.getElementById('passwordOverlay').style.display = 'none';
            document.getElementById('mainContent').style.display = 'block';
            loadSlips();
        }

        function loadSlips() {
            fetch('slips.json')
                .then(res => {
                    if (!res.ok) throw new Error('No data');
                    return res.json();
                })
                .then(data => {
                    displaySlips(data);
                })
                .catch(err => {
                    document.getElementById('slipsContainer').innerHTML = `
                        <div class="no-slips">
                            <i class="fas fa-gift"></i>
                            <p>ยังไม่มีรายการสลิปโอนเงิน</p>
                        </div>
                    `;
                    document.getElementById('totalSlips').textContent = '0';
                    document.getElementById('totalAmount').textContent = '฿0';
                });
        }

        function displaySlips(slips) {
            if (!slips || slips.length === 0) {
                document.getElementById('slipsContainer').innerHTML = `
                    <div class="no-slips">
                        <i class="fas fa-gift"></i>
                        <p>ยังไม่มีรายการสลิปโอนเงิน</p>
                    </div>
                `;
                return;
            }

            // Sort by newest first
            slips.sort((a, b) => new Date(b.uploaded_at) - new Date(a.uploaded_at));

            // Calculate totals
            document.getElementById('totalSlips').textContent = slips.length;
            
            let totalAmount = 0;
            slips.forEach(slip => {
                const amount = parseFloat(slip.amount.replace(/[^0-9.]/g, '')) || 0;
                totalAmount += amount;
            });
            document.getElementById('totalAmount').textContent = '฿' + totalAmount.toLocaleString();

            // Generate cards
            let html = '<div class="slips-grid">';
            slips.forEach(slip => {
                const date = new Date(slip.uploaded_at);
                const dateStr = date.toLocaleDateString('th-TH', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                html += `
                    <div class="slip-card">
                        <img src="uploads/${slip.filename}" alt="Slip" class="slip-image" onclick="openLightbox('uploads/${slip.filename}')">
                        <div class="slip-info">
                            <div class="slip-name"><i class="fas fa-user"></i> ${escapeHtml(slip.name)}</div>
                            ${slip.amount ? `<div class="slip-amount">฿${escapeHtml(slip.amount)}</div>` : ''}
                            ${slip.message ? `<div class="slip-message">"${escapeHtml(slip.message)}"</div>` : ''}
                            <div class="slip-date"><i class="fas fa-clock"></i> ${dateStr}</div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';

            document.getElementById('slipsContainer').innerHTML = html;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.add('active');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        // Close lightbox with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
</body>
</html>
