<!DOCTYPE html>
<html>
<head>
    <style>
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 13px;
            margin: 36pt;
            position: relative
        }
        .mainlayout {
            width: 100%;
            max-width: 991px;
            margin: auto;
            position: relative;
        }
        img {
            max-width: 150px;
        }
        .header {
            display: table;
            width: 100%;
        }
        .header_content {
            display: table-cell;
            vertical-align: middle;
        }
        .header_logo {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }
        .header_title {
            font-weight: 600;
            font-size: 30px;
            margin: 0;
            margin-bottom: 10px;
        }
        .invoice_from_to {
            display: table;
            width: 100%;
            margin: 20px 0;
            border-bottom: 1px solid #d0cece;
            padding-bottom: 10px;
        }
        .invoice_from_to h2 {
            font-size: 16px;
            margin-bottom: 7px;
            font-weight: bold;
        }
        h2,
        p {
            margin: 0
        }
        .invoice_to,
        .invoice_from {
            display: table-cell;
            vertical-align: middle;
        }
        .invoice_from {
            text-align: right;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .invoice_table th {
            background: #b85eea;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f7f4f4;
        }
        .invoice_footer {
            width: auto;
            text-align: right;
            margin: 0;
            padding: 15px 0;
        }
        .single_footer>span {
            width: 80px;
            display: inline-block;
        }
        .single_footer>strong {
            width: 60px;
            display: inline-block;
        }
        .single_footer {
            padding: 3px 0;
        }
        .amount_total {
            float: right;
        }
        .single_footer strong span {
            margin-right: 10px;
        }
        .amount_total h2 {
            font-size: 13px;
            display: block;
            padding: 5px 20px;
            background: #ee1653;
            color: #fff;
            width: auto;
            text-align: center;
        }
        .copyright {
            position: absolute;
            left: 0px;
            bottom: 0px;
            font-size: 8px
        }
    </style>
</head>

<body>

    <section class="mainlayout">
        <div class="header">
            <div class="header_content">
                <h2 class="header_title">INVOICE</h2>
                <div>
                    <span class="w-1/3">INVOICE NO</span>
                    <strong class="w-3/5"><span class="mx-5">:</span> INVO_1423534</strong>
                </div>
                <div>
                    <span class="w-1/3">INVOICE DATE</span>
                    <strong class="w-3/5"><span class="mx-5">:</span>January 20, 2022</strong>
                </div>
                <div>
                    <span class="w-1/3">INVOICE DUE</span>
                    <strong class="w-3/5"><span class="mx-5">:</span> January 28, 2022</strong>
                </div>
            </div>
            <div class="header_logo">
                <img src="img/logo.png" class="w-40" alt="">
            </div>
        </div>
        <div class="invoice_from_to">
            <div class="invoice_to">
                <h2>INVOICE TO</h2>
                <p><strong class="">Jhon Deo</strong></p>
                <p><small class="">shamim@gmail.com</small></p>
                <p><small class="">+1234567</small></p>
                <p><small class="">USA</small></p>
            </div>
            <div class="invoice_from">
                <h2>FROM</h2>
                <p><strong class="">Shamim Ahmed</strong></p>
                <p><small class="">fixCafe Network</small></p>
                <p><small class="">admin@pixcafe.com</small></p>
                <p><small class="">Bangladesh</small></p>
            </div>
        </div>
        <div class="invoice_list">
            <table class="invoice_table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: center">Discount ($)</th>
                        <th style="text-align: right">Amount ($)</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                        <td style="text-align:center">0</td>
                        <td style="text-align:right">400</td>
                    </tr>

                </tbody>
            </table>

            <div class="invoice_footer">
                <div class="single_footer">
                    <span>Subtotal: </span>
                    <strong> $16000</strong>
                </div>
                <div class="single_footer">
                    <span>Discount: </span>
                    <strong>0</strong>
                </div>
                <div class="single_footer">
                    <span>Total: </span>
                    <strong>$1600</strong>
                </div>
            </div>
            <div class="amount_total">
                <h2><span>Amount Due:</span> <strong>$1600</strong></h2>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; Copyright PixCafe Network. All Right Reserved.</p>
        </div>
    </section>

</body>

</html>
