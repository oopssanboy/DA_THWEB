<?php
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../../../autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THANH TOAN</title>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 20px;
        }
        .qr {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 500px;
            width: 100%;
            border: 1px solid #eee;
        }
        .qr h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            text-transform: uppercase;
            border-bottom: 2px solid #5cbbb6; 
            padding-bottom: 10px;
            display: inline-block;
        }
        .qr img {
            width: 100%;
            max-width: 250px; 
            height: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 30px;
            background: #fff;
        }
        .qr form {
            width: 100%;
        }
        .qr button {
            width: 100%;
            padding: 15px;
            background-color: #333; 
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .qr button:hover {
            background-color: #5cbbb6; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(92, 187, 182, 0.4);
        }
        @media (max-width: 768px) {
            .qr {
                padding: 20px;
                margin: 20px;
            }
            .qr h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include_once '../header/header.php'; ?>
    
    <div class="qr-container">
        <div class="qr">
            <h1>Chuyển khoản ngân hàng</h1>
            <p style="margin-bottom: 20px; color: #666;">Vui lòng quét mã QR bên dưới để thanh toán</p>
            
            <img src="/images/qr.jpg" alt="Mã QR Chuyển Khoản">
            
            <form method="POST" action="/controler/giohangcontroler.php?action=dathanhtoan">
                <button type="submit">Xác nhận đã thanh toán</button>
            </form>
        </div>
    </div>

    <?php include_once '../footer/footer.php'; ?>
</body>
</html>