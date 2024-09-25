<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-gj53nEP_n_1uvkMwXm0AlhE-';
Config::$clientKey = 'SB-Mid-client-8tBm4kxRHpg37quC';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

if(empty($order_id)) {
    echo "ID is required.";
    exit;
}

require_once '../../../koneksi.php';

$query = "SELECT pesanan.id, pesanan.atas_nama, pesanan.nim, pesanan.telepon, menu.nama AS nama_menu, menu.harga AS harga_menu, pesanan.kuantitas, pesanan.status_transaksi,pesanan.order_id, pesanan.layanan, pesanan.harga_total, pesanan.status_pesanan FROM pesanan INNER JOIN menu ON pesanan.menu_id = menu.id WHERE pesanan.order_id = '$order_id'";
$result = mysqli_query($koneksi, $query);

if(!$result || mysqli_num_rows($result) == 0) {
    echo "Order not found.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Required
$transaction_details = array(
    'order_id' => $row['order_id'],
    'gross_amount' => $row['harga_menu'], // no decimal allowed for creditcard
);
// Optional
$item_details = array(
    array(
        'id' => $row['id'],
        'price' => $row['harga_menu'],
        'quantity' => $row['kuantitas'],
        'name' => $row['nama_menu']
    ),  
);
// Optional
$customer_details = array(
    'first_name'    => $row['atas_nama'],
    'phone'         => $row['telepon'],
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-gj53nEP_n_1uvkMwXm0AlhE-\';');
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        #pay-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 32px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        #pay-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Silahkan memilih metode pembayaran</h1>
        <button id="pay-button">Pilih Metode Pembayarans</button>
    </div>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>');
        };
    </script>
</body>

</html>
