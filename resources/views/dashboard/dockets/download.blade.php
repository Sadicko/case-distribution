<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Allocation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 100%;
            max-width: 650px; /* Adjust width as needed */
            margin: 0 auto; /* Centers the content */
            padding: 20px;
            box-sizing: border-box;
        }

        .content {
            border: 1px solid black;
            padding: 20px;
            box-sizing: border-box;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .col-2 {
            flex: 0 0 20%;
            max-width: 20%;
            font-weight: bold;
            font-size: 12px;
        }

        .col-10 {
            flex: 0 0 80%;
            max-width: 80%;
            font-size: 12px;
        }

        img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #333;
            position: fixed;
            bottom: 10mm;
            width: 100%;
        }

        @media print {
            @page {
                size: A5;
                margin: 10mm; /* Equal margins on all sides */
            }

            .wrapper {
                padding: 0;
                margin: 0 auto;
            }

            .footer {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="content">
            <div class="text-center">
                <h3 class="text-uppercase">Judicial Service of Ghana</h3>
                <h5 class="text-uppercase">Electronic Case Distribution System</h5>
                <img src="images/coat_of_arms.png" alt="Coat of Arms">
            </div>

            <h3 class="text-uppercase text-center">Case Allocation</h3>

            <div class="row">
                <div class="col-2">Case Title:</div>
                <div class="col-10 text-uppercase">Tenetur Vitae Fugit Distinctio Atque Aliquid.</div>
            </div>
            <div class="row">
                <div class="col-2">Suit Number:</div>
                <div class="col-10 text-uppercase">MM/0005/2020</div>
            </div>
            <div class="row">
                <div class="col-2">Allocated Court:</div>
                <div class="col-10 text-uppercase">Commercial Court 1</div>
            </div>
            <div class="row">
                <div class="col-2">Location:</div>
                <div class="col-10 text-uppercase">Accra - The Law Court Complex</div>
            </div>
            <div class="row">
                <div class="col-2">Judge Name:</div>
                <div class="col-10 text-uppercase">John Doe</div>
            </div>
            <div class="row">
                <div class="col-2">Case Category:</div>
                <div class="col-10 text-uppercase">Commercial</div>
            </div>
            <div class="row">
                <div class="col-2">Date of Allocation:</div>
                <div class="col-10 text-uppercase">02 Dec, 2024 at 12:59 PM</div>
            </div>
        </section>

        <div class="footer">
            Powered by Judicial Service ICT
        </div>
    </div>
</body>
</html>
