<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .address-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .address-table th, .address-table td {
            padding: 8px;
            text-align: left;
            border: none;
        }

        .invoice-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .invoice-table th, .invoice-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="header">
        <h1>Invoice</h1>
    </div>

    <table class="address-table">
        <tr>
            <th>From:</th>
            <td>Your Company</td>
        </tr>
        <tr>
            <th></th>
            <td>Address Line 1</td>
        </tr>
        <tr>
            <th></th>
            <td>Address Line 2</td>
        </tr>
        <tr>
            <th></th>
            <td>City, Country</td>
        </tr>
        <tr>
            <th>To:</th>
            <td>Client Name</td>
        </tr>
        <tr>
            <th></th>
            <td>Client Address Line 1</td>
        </tr>
        <tr>
            <th></th>
            <td>Client Address Line 2</td>
        </tr>
        <tr>
            <th></th>
            <td>City, Country</td>
        </tr>
    </table>

    <table class="invoice-table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Product 1</td>
            <td>2</td>
            <td>$50.00</td>
            <td>$100.00</td>
        </tr>
        <tr>
            <td>Product 2</td>
            <td>1</td>
            <td>$75.00</td>
            <td>$75.00</td>
        </tr>
        </tbody>
    </table>

    <div class="total">
        <strong>Total:</strong> $175.00
    </div>
</div>
</body>
</html>
