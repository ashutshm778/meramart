<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.40, maximum-scale=1.5">
    <meta name="description" content="theme_five">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"
        type="text/css">
    <style>
        html {
            background-color: #F2F2F2;
        }

        body {
            margin: 0 auto;
            font-family: 'Roboto', sans-serif;
            background-color: white;
        }

        .page-footer {
            display: flex;
            align-items: center;
            font-size: 3.5mm;
            justify-content: center;
            font-weight: 500;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 3.5mm;
            font-weight: 500;
        }

        table {
            width: 100%;
        }

        .main-container {
            padding: 0 !important;
        }


        .page-header-type {
            display: flex;
            align-items: center;
        }

        .page-header-type-value {
            margin-right: 10px;
        }

        .page-header-sub-type {
            border: 1px solid #868597;
            box-sizing: border-box;
            border-radius: 2px;
            color: #868597;
            letter-spacing: 0.15px;
            text-transform: uppercase;
            margin-right: 4px;
        }

        .page-header-tagline {
            font-weight: 500;
        }

        .page-header-tagline-container {
            display: flex;
            align-items: flex-end;
            flex-direction: column;
        }

        /* Typography */
        .text-small {
            font-size: 11px;
        }

        .text-smallest {
            font-size: 10px !important;
        }

        /* Company Details */
        #company-details {
            border: 1px solid black;
            min-height: 25mm;
            display: flex;
        }

        #company-details-meta {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .company-logo-container {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            display: flex;
            margin: 1mm;
            object-fit: contain;
        }

        #company-logo {
            margin: 2.1mm;
            object-fit: contain;
        }

        #company-details-content {
            flex: 1;
            margin: 1mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        #company-name {
            font-size: 16px;
            font-weight: 600;
            color: #BF6200;
            margin-bottom: 0.5mm;
        }

        #company-address {
            font-size: 12px;
            margin-bottom: 1mm;
        }

        #company-contact-details,
        #company-contact-details-2,
        #company-email-content,
        #company-pan-number-content {
            display: flex;
            font-size: 12px;
            align-items: center;
        }

        #company-gst-number-content {
            margin-right: 3mm;
        }

        #company-gst-number-content>span:first-child,
        #company-mobile-number-content>span:first-child,
        #company-email-content>span:first-child,
        #company-pan-number-content>span:first-child {
            font-weight: 500;
        }

        /* Invoice Details */
        #invoice-details-meta {
            display: flex;
            flex-direction: column;
            border-left: 1px solid black;
            flex: 1;
        }

        #invoice-main-details {
            flex: 1;
            display: flex;
            align-items: center;
            font-size: 12px;
            text-align: center;
            justify-content: space-around;
            font-weight: 600;
        }

        #invoice-main-details>div {
            min-width: 33%;
        }

        #invoice-main-details>div>div:last-child {
            font-weight: 400;
        }

        #invoice-sub-details {
            flex: 1;
            border-top: 1px solid black;
            display: flex;
            font-size: 12px;
            text-align: center;
            justify-content: space-around;
        }

        #invoice-sub-details>div {
            padding-top: 2mm;
            word-break: break-all;
            min-width: 20mm;
            margin: 0 2mm;
        }

        #invoice-sub-details>div>div:first-child {
            font-weight: 600;
        }

        /* Address Details */
        #address-details {
            border-left: 1px solid black;
            border-right: 1px solid black;
            display: flex;
        }

        .meta-bill-ship-to {
            font-size: 11px;
            padding-bottom: 8px;
            line-height: 14px;
        }

        .meta-bill-ship-to>div {
            margin-left: 2mm;
            margin-right: 2mm;
            margin-bottom: 2px;
            display: flex;
        }

        #bill-to {
            flex: 1;
        }

        #ship-to {
            flex: 1;
            border-left: 1px solid black;
        }

        .title-bill-ship-to {
            margin: 2mm;
            margin-bottom: 1mm;
            font-size: 3mm;
            font-weight: 500;
        }

        #bill-to-company-name,
        #ship-to-company-name {
            font-size: 12px;
            font-weight: 600;
            margin-left: 2mm;
            margin-right: 2mm;
            margin-bottom: 1mm;
            text-transform: uppercase;
        }

        .field-bill-ship-to {
            margin-right: 1.5mm;
        }

        .mr-4 {
            margin-right: 4mm;
        }

        #party-addn-field-container {
            display: flex;
            flex-direction: column;
        }

        .party-addn-field {
            display: flex;
            font-size: 11px;
            line-height: 14px;
            flex-direction: row;
        }

        /* Items table */
        #items-table {
            border: 1px solid black;
            border-collapse: collapse;
            border-spacing: 0 !important;
            margin: 0;
            padding: 0;
        }

        #items-table tr {
            padding: .35em;
            page-break-inside: avoid;
        }

        #items-table th,
        #items-table td {
            padding: .625em;
            border-right: 1px solid black;
            max-width: 75mm;
            page-break-inside: avoid;
        }

        .items-table-header {
            font-size: 3mm;
            font-weight: 500;
            background-color: rgba(247, 144, 34, 0.2);
            border-bottom: 1px solid black;
            min-height: 5mm;
        }

        .items-table-info {
            font-size: 11px;
            font-weight: 400;
            justify-content: center;
            word-break: break-word;
            vertical-align: top;
            padding: 2mm;
            padding-top: 0.5mm;
            padding-bottom: 0.5mm;
            flex-direction: column;
        }

        .item-serial-number {
            text-align: center;
        }

        .item-serial-no,
        .item-imei {
            font-size: 10px;
            margin-top: 2px;
            color: rgba(0, 0, 0, 0.7);
        }

        .item-hsn,
        .item-quantity,
        .item-mrp,
        .item-rate,
        .item-charge-rate,
        .item-additional-info-rate,
        .item-discount-amount,
        .item-tax-amount,
        .item-sgst-amount,
        .item-cgst-amount,
        .item-igst-amount,
        .item-charge-tax-amount,
        .item-additional-info-tax-amount,
        .item-charge-sgst-amount,
        .item-additional-info-sgst-amount,
        .item-charge-cgst-amount,
        .item-additional-info-cgst-amount,
        .item-charge-igst-amount,
        .item-additional-info-igst-amount,
        .item-cess-amount,
        .item-total {
            text-align: right;
        }

        .item-discount-percentage,
        .item-tax-percentage,
        .item-sgst-percentage,
        .item-cgst-percentage,
        .item-igst-percentage,
        .item-charge-tax-percentage,
        .item-charge-sgst-percentage,
        .item-charge-cgst-percentage,
        .item-charge-igst-percentage,
        .item-cess-percentage {
            color: rgba(0, 0, 0, 0.6);
            text-align: right;
            font-size: 10px;
        }

        .items-addn1-column,
        .items-addn2-column,
        .items-addn3-column,
        .items-addn4-column {
            text-align: center !important;
        }

        .items-discount-column,
        .tax-column,
        .items-hsn-column,
        .tax-sgst-column,
        .tax-cgst-column,
        .tax-igst-column,
        .items-cess-column,
        .items-qty-column,
        .items-rate-column {
            white-space: nowrap;
        }

        .nowrap {
            white-space: nowrap;
        }

        /* Additional Charges */
        .item-charge-dash,
        .item-charge-label,
        .item-charge-value,
        .item-additional-info-dash,
        .item-additional-info-label,
        .item-additional-info-value {
            text-align: right;
        }

        .item-charge-label,
        .item-additional-info-label {
            font-size: 11px;
            font-style: italic;
            padding-right: 1mm;
            font-weight: 500;
        }

        /* Tax Table */
        #tax-table {
            border: 1px solid black;
            border-collapse: collapse;
            border-spacing: 0 !important;
            margin: 2mm 0;
            padding: 0;
        }

        #tax-table tr {
            page-break-inside: avoid;
        }

        #tax-table th,
        #tax-table td {
            border-right: 1px solid black;
            max-width: 25%;
            page-break-inside: avoid;
        }

        .tax-table-header {
            font-size: 3mm;
            font-weight: 500;
            background-color: rgba(247, 144, 34, 0.2);
            border-bottom: 1px solid black;
        }

        .tax-table-sub-header {
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-top: 1px solid black;
        }

        .tax-table-sub-header>div:last-child {
            border-left: 1px solid black;
        }

        .tax-table-rate-header {
            width: 30%;
            display: flex;
            justify-content: center;
        }

        .tax-table-amount-header {
            width: 70%;
            display: flex;
            justify-content: center;
        }

        .tax-table-info {
            font-size: 12px;
            word-break: break-all;
            padding: 0.5mm 2mm;
            text-align: right;
        }

        .tax-table-sub-info {
            padding: 0;
            height: 1px;
        }

        .tax-table-sub-info>div {
            font-size: 3mm;
            word-break: break-all;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100%;
        }

        .tax-cgst-rate,
        .tax-sgst-rate,
        .tax-igst-rate {
            width: 30%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 0.5mm;
        }

        .tax-cgst-amount,
        .tax-sgst-amount,
        .tax-igst-amount {
            width: 70%;
            display: flex;
            justify-content: flex-end;
            height: 100%;
            align-items: center;
            padding: 0 1mm;
            border-left: 1px solid black;
        }

        /* Amount in words */
        #amount-words,
        #foreign-amount-words {
            display: flex;
            flex: 1;
            flex-direction: column;
            min-height: 5mm;
            align-items: center;
        }

        #amount-words-container {
            border: 1px solid black;
            padding-bottom: 4px;
        }

        #amount-words-label,
        #foreign-amount-words-label {
            align-self: flex-start;
            padding-right: 2mm;
            font-size: 12px;
            padding-left: 2mm;
            padding-top: 1mm;
            padding-bottom: 1mm;
            font-weight: 500;
        }

        #amount-words-value,
        #foreign-amount-words-value {
            padding-right: 2mm;
            font-size: 11px;
            padding-left: 2mm;
            flex: 1;
            align-self: flex-start;
        }

        #amount-words-container {
            display: flex;
            flex-direction: row;
        }

        /* Misc Details */
        .misc-details-container {
            display: flex;
            border-left: 1px solid black;
        }

        .bottom-content-container {
            break-inside: avoid;
        }

        .misc-details-container>div {
            flex: 1 0;
            border-bottom: 1px solid black;
            border-right: 1px solid black;
            overflow-wrap: anywhere;
        }

        #notes-label,
        #bank-details-label,
        #tnc-label {
            padding: 2mm;
            padding-bottom: 1mm;
            padding-top: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        #notes,
        #tnc {
            page-break-inside: avoid;
        }

        #upi-scan-label {
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        #notes-value,
        #tnc-value {
            font-size: 11px;
            word-break: break-word;
            padding-left: 2mm;
            padding-right: 2mm;
        }

        /* Bank Details */
        .bank-details-info {
            display: flex;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .bank-details-info-label {
            padding-left: 2mm;
            width: 30%;
            min-width: 30%;
        }

        .bank-details-value {
            max-width: 70%;
            margin-right: 2mm;
        }

        /* UPI Details */
        #upi-details {
            display: flex;
            justify-content: space-between;
        }

        #upi-details-meta {
            flex-grow: 1;
            font-size: 11px;
            padding: 4px;
        }

        #upi-id {
            word-break: break-all;
        }

        #upi-qr-code {
            height: 18mm;
            padding: 2mm;
        }

        #upi-scan-desc {
            margin-bottom: 1mm;
            color: rgba(0, 0, 0, 0.8);
        }

        /* Signature */
        #signature {
            page-break-inside: avoid;
        }

        #signature-img-container {
            margin-top: 8px;
            height: 15mm;
            text-align: center;
        }

        #signature-img {
            height: 100%;
            max-width: 100px;
            object-fit: contain;
        }

        #signature-label,
        #signatory-name {
            font-size: 11px;
            text-align: center;
        }

        /* Total and party balance */
        .items-table-total,
        .items-table-total-foreign {
            font-size: 3mm;
            font-weight: 500;
            background-color: rgba(247, 144, 34, 0.2);
            border-top: 1px solid black;
            text-align: end;
            word-break: break-all;
            padding: 0 1mm;
        }

        td[class^="items-table-tax-total-"],
        .items-table-balance,
        .items-table-received,
        .items-table-prev-balance,
        .items-table-curr-balance {
            font-size: 3mm;
            font-weight: 500;
            border-top: 1px solid black;
            text-align: end;
            word-break: break-all;
            padding: 0 1mm;
        }

        /* Highlights */
        .highlight {
            border: 3px dashed #DE776F !important;
            background: rgba(245, 212, 209, 0.2);
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        .highlight-padding {
            padding-top: 2mm;
            padding-bottom: 2mm;
            padding-left: 4mm;
            padding-right: 4mm;
        }

        .plus-missing-field-text {
            font-size: small;
            display: inline-block;
            vertical-align: middle;
        }

        .plus-missing-field-icon {
            margin: 2mm 4mm;
            display: inline-block;
            vertical-align: middle;
        }

        /* Page branding */
        .page-branding {
            font-size: 2.5mm;
            display: none;
        }

        /* MBB Pay */
        #upi-mbb-container {
            margin-left: 1mm;
        }

        #mbb-pay {
            margin-top: 8px;
            margin-bottom: 12px;
        }

        #upi-apps {
            margin-bottom: 0px;
            margin-top: 8px;
        }

        #payment-link-container {
            display: none;
            line-height: 23px;
            margin-bottom: -8px;
        }

        #payment-cta {
            font-weight: bold;
            font-size: 2.5mm;
            color: white;
            background-color: #BF6200;
            border-radius: 1.8mm;
            padding: 1.5mm 2.5mm;
            text-decoration: none;
        }

        #payment-link {
            color: #BF6200;
            font-size: 3mm;
            margin-left: 1mm;
            text-decoration: none;
        }

        /* E-Invoicing */
        #e-invocing-container {
            margin-top: 8px;
            border: 1px solid #000;
            padding: 8px;
            display: flex;
            flex-direction: row;
            page-break-inside: avoid;
        }

        #e-invoice-qr {
            height: 100px;
            width: 100px;
            margin-right: 8px;
        }

        #e-invoicing-info-container {
            flex: 1;
        }

        .e-info-container {
            font-size: 10px;
            margin-top: 8px;
            display: flex;
            flex-direction: row;
        }

        .e-info-label {
            width: 100px;
        }

        #e-invoice-description {
            font-size: 10px;
            margin-top: 12px;
        }

        #e-invoice-details {
            font-weight: 600;
            font-size: 12px;
            text-align: center;
            margin-right: 116px;
        }

        /* Common classes */
        .bold {
            font-weight: 600;
        }

        /* MBB Logo Container */
        #mbb-logo-container {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }
    </style>
    <style>
        @media screen {
            .page-header {
                height: 10mm;
            }

            .page-footer {
                height: 10mm;
            }

            body {
                padding: 4mm 10mm;
                width: 190mm;
            }
        }

        @media print {
            html {
                background-color: initial;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .page-footer {
                width: 100%;
                position: fixed;
                bottom: 0;
                padding-bottom: 2mm;
            }

            .page-header {
                width: 100%;
                position: fixed;
                top: 0;
                padding-top: 2mm;
            }

            #main-header {
                display: table-header-group;
            }

            #main-footer {
                display: table-footer-group;
            }

            .page-header,
            .page-header-space {
                height: 11mm;
            }

            .page-footer,
            .page-footer-space {
                height: 9mm;
            }

            .highlight {
                display: none;
                visibility: hidden;
            }
        }

        @page {
            size: A4;
            margin: 0mm 10mm;
        }

        .page-header-tagline {
            font-size: 3.5mm;
        }

        .page-header-sub-type {
            padding: 2px 4px;
        }

        /* Company Details */
        .company-logo-container,
        #company-logo {
            height: 23mm;
            width: 23mm;
        }

        #company-details-content {
            text-align: center;
            align-items: center;
        }

        #company-mobile-number-content,
        #company-email-content {
            padding-right: 16px;
        }

        #dummy-div {
            height: 100%;
            width: 23mm;
        }

        /* Item Details */
        #items-table {
            margin-bottom: 2mm;
        }

        /* Misc Details */
        .misc-details-container {
            flex-flow: row wrap;
        }

        .misc-details:nth-last-child(5):first-child,
        .misc-details:nth-last-child(5):first-child~.misc-details {
            flex-basis: 30%;
        }

        .misc-details:nth-last-child(4):first-child,
        .misc-details:nth-last-child(4):first-child~.misc-details {
            flex-basis: 40%;
        }

        /* UPI Details */
        #upi-details {
            display: block;
        }

        #upi-details-container {
            display: flex;
            justify-content: space-between;
        }

        .sub-details-class,
        #invoice-main-details {
            min-height: 12mm;
        }
    </style>
    <style>
        @media print {
            .page-header {
                height: 15mm
            }
        }
    </style>
    <style>
        @media print {
            .page-header-space {
                height: 15mm
            }
        }
    </style>
</head>

<body>

    <!-- Page Header -->
    <div class="page-header" style="height: 14mm">
        <div class="page-header-type">

        </div>
        <div class="page-header-tagline-container">
            <div id="mbb-logo-container">

            </div>
            <div class="page-header-tagline-value"></div>
        </div>
    </div>
    @php
        $logo = App\Models\Admin\WebsiteSetting::where('type', 'logo')->first();
    @endphp
    <!-- Main Content -->
    <div id="main-content">
        <table>
            <thead id="main-header">
                <tr>
                    <td>
                        <div class="page-header-space"></div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="main-container">
                        <!-- Theme Content -->
                        <div class="page">

                            <!-- Company details -->
                            <div id="company-details">
                                <div id="company-details-meta">
                                    <div id="company-logo-container">
                                        <img id="company-logo"
                                            src="{{ asset('public/' . api_asset(websiteSettingValue('logo'))) }}" />
                                    </div>
                                    <div id="company-details-content">
                                        <div id="company-name" style="color: #CD9D23;">{{ env('APP_NAME') }}</div>
                                        <div id="company-address">{{ websiteSettingValue('address') }}</div>

                                        <div id="company-contact-details">
                                            <div id="company-mobile-number-content">
                                                <span>Mobile:</span>&nbsp;
                                                <span
                                                    id="company-mobile-number">{{ websiteSettingValue('phone') }}</span>
                                            </div>
                                            <div id="company-email-content">
                                                <span>Email:</span>&nbsp;
                                                <span id="company-email">{{ websiteSettingValue('email') }}</span>
                                            </div>
                                            <div id="company-pan-number-content">
                                                <span>PAN Number:</span>&nbsp;
                                                <span id="company-pan-number">BUPPA2790D</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dummy-div"></div>
                                </div>
                            </div>
                            @php
                                $address = json_decode($order->shipping_address);
                            @endphp
                            <!-- Address details -->
                            <div id="address-details">
                                <div id="bill-to">
                                    <div id="title-bill-to" class="title-bill-ship-to">BILL TO</div>
                                    <div id="bill-to-company-name">{{ $address->name }}</div>
                                    <div class="meta-bill-ship-to">
                                        <div id="bill-to-address-container">
                                            <span class="field-bill-ship-to">Address:</span>
                                            <span id="bill-to-address">{{ $address->address }}
                                                {{ $address->city->city }} {{ $address->state->state }}
                                                {{ $address->country }} - {{ $address->pincode }}</span>
                                        </div>
                                        <div>
                                            <div id="bill-to-mobile-container" class="mr-4">
                                                <span class="field-bill-ship-to">Mobile:</span>
                                                <span id="bill-to-mobile">{{ $address->phone }}</span>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="invoice-details-meta">
                                    <div id="invoice-main-details">
                                        <div id="invoice-number-container">
                                            <div id="invoice-number-label">Invoice No.</div>
                                            <div id="invoice-number">{{ $order->order_id }}</div>
                                        </div>
                                        <div id="invoice-date-container">
                                            <div id="invoice-date-label">Invoice Date</div>
                                            <div id="invoice-date">{{ $order->created_at->format('d-M-Y h:i A') }}
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <!-- Items Table -->
                            <table id="items-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="items-table-header"
                                            style="background-color: #F1E7CF;">S.NO.</th>
                                        <th scope="col" class="items-table-header items-type-header"
                                            style="background-color: #F1E7CF;">ITEM NAME</th>




                                        <th scope="col" class="items-table-header items-qty-column"
                                            style="background-color: #F1E7CF;">QTY.</th>
                                        <th scope="col" class="items-table-header items-mrp-header items-mrp-column"
                                            style="background-color: #F1E7CF;">MRP
                                        </th>
                                        <th scope="col"
                                            class="items-table-header items-rate-header items-rate-column"
                                            style="background-color: #F1E7CF;">RATE
                                        </th>
                                        <th scope="col" class="items-table-header items-discount-column"
                                            style="background-color: #F1E7CF;">DISC.</th>
                                        <th scope="col" class="items-table-header"
                                            style="background-color: #F1E7CF;">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody id="items-table-content">
                                    @foreach ($order->order_details as $key => $order_detail)
                                        <tr>
                                            <td class="items-table-info item-serial-number" style="">
                                                {{ $key + 1 }}</td>
                                            <td class="items-table-info item-name-desc" style="">
                                                <div class="item-name">{{ $order_detail->product->name }}</div>
                                            </td>
                                            <td class="items-table-info item-quantity items-qty-column" style="">
                                                {{ $order_detail->quantity }} PCS
                                            </td>
                                            <td class="items-table-info item-mrp items-mrp-column" style=" nowrap">
                                                {{ $order_detail->mrp_price }}</td>
                                            <td class="items-table-info item-rate items-rate-column" style="">
                                                {{ $order_detail->price }}
                                            </td>
                                            <td class="items-table-info items-discount-column" style="">
                                                <div class="item-discount-amount">{{ $order_detail->discounted_price }}
                                                </div>
                                                <div class="item-discount-percentage">(11.11%)</div>
                                            </td>
                                            <td class="items-table-info item-total nowrap" style="">3,999</td>
                                        </tr>
                                    @endforeach
                                    <tr class="empty-row" style="height: 98.55833335720001mm">
                                        <td class="items-table-info item-serial-number" style=""></td>
                                        <td class="items-table-info item-name-desc" style="">
                                            <div class="item-name"></div>
                                            <div class="item-imei"></div>
                                            <div class="item-serial-no"></div>
                                        </td>
                                        <td class="items-table-info item-quantity items-qty-column" style="">
                                        </td>
                                        <td class="items-table-info item-mrp items-mrp-column" style=" nowrap"></td>
                                        <td class="items-table-info item-rate items-rate-column" style=""></td>
                                        <td class="items-table-info items-discount-column" style="">
                                            <div class="item-discount-amount"></div>
                                            <div class="item-discount-percentage"></div>
                                        </td>
                                        <td class="items-table-info item-total nowrap" style=""></td>
                                    </tr>
                                    <tr>
                                        <td class="items-table-info item-serial-number-charge" style=""></td>
                                        <td class="items-table-info item-additional-info-label" style="">CGST
                                            @2.5%</td>
                                        <td class="items-table-info item-additional-info-dash items-qty-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-rate items-rate-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-rate items-rate-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-dash items-discount-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-value nowrap">₹ 24.75</td>
                                    </tr>
                                    <tr>
                                        <td class="items-table-info item-serial-number-charge" style=""></td>
                                        <td class="items-table-info item-additional-info-label" style="">SGST
                                            @2.5%</td>
                                        <td class="items-table-info item-additional-info-dash items-qty-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-rate items-rate-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-rate items-rate-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-dash items-discount-column"
                                            style="">-</td>
                                        <td class="items-table-info item-additional-info-value nowrap">₹ 24.75</td>
                                    </tr>
                                    <tr>
                                        <td class="items-table-total" style="background-color: #F1E7CF;"></td>
                                        <td id="items-table-total-label" class="bold items-table-total"
                                            style="background-color: #F1E7CF;">TOTAL</td>
                                        <td id="items-table-total-qty" class="bold items-table-total items-qty-column"
                                            style="background-color: #F1E7CF;">1</td>
                                        <td class="items-table-total items-mrp-column nowrap"
                                            style="background-color: #F1E7CF;"></td>
                                        <td class="items-table-total items-rate-column"
                                            style="background-color: #F1E7CF;"></td>
                                        <td id="items-table-total-discount"
                                            class="bold items-table-total items-discount-column"
                                            style="background-color: #F1E7CF;">₹ 500</td>
                                        <td id="items-table-total-amount" class="bold items-table-total nowrap"
                                            style="background-color: #F1E7CF;">₹ 3,999</td>
                                    </tr>

                                </tbody>
                            </table>


                            <table id="tax-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="tax-table-header"
                                            style="background-color: #F1E7CF;">HSN/SAC</th>
                                        <th scope="col" class="tax-table-header"
                                            style="background-color: #F1E7CF;">Taxable Value</th>
                                        <th scope="col" class="tax-table-header tax-cgst-column"
                                            style="background-color: #F1E7CF;">
                                            <div>CGST</div>
                                            <div class="tax-table-sub-header">
                                                <div class="tax-table-rate-header">Rate</div>
                                                <div class="tax-table-amount-header">Amount</div>
                                            </div>
                                        </th>
                                        <th scope="col" class="tax-table-header tax-sgst-column"
                                            style="background-color: #F1E7CF;">
                                            <div class="label-sgst">SGST</div>
                                            <div class="tax-table-sub-header">
                                                <div class="tax-table-rate-header">Rate</div>
                                                <div class="tax-table-amount-header">Amount</div>
                                            </div>
                                        </th>


                                        <th scope="col" class="tax-table-header"
                                            style="background-color: #F1E7CF;">Total Tax Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tax-table-content">
                                    <tr>
                                        <td class="tax-table-info tax-hsn">-</td>
                                        <td class="tax-table-info tax-value">990</td>
                                        <td class="tax-table-sub-info tax-cgst-column">
                                            <div>
                                                <div class="tax-cgst-rate">2.5%</div>
                                                <div class="tax-cgst-amount">24.75</div>
                                            </div>
                                        </td>
                                        <td class="tax-table-sub-info tax-sgst-column">
                                            <div>
                                                <div class="tax-sgst-rate">2.5%</div>
                                                <div class="tax-sgst-amount">24.75</div>
                                            </div>
                                        </td>
                                        <td class="tax-table-info tax-amount">₹ 49.5</td>
                                    </tr>
                                    <tr>
                                        <td class="tax-table-info bold">Total</td>
                                        <td class="tax-table-info" id="total-tax-value">990</td>
                                        <td class="tax-table-sub-info tax-cgst-column">
                                            <div>
                                                <div class="tax-cgst-rate"></div>
                                                <div class="tax-cgst-amount" id="total-tax-cgst-amount">24.75
                                                </div>
                                            </div>
                                        </td>
                                        <td class="tax-table-sub-info tax-sgst-column">
                                            <div>
                                                <div class="tax-sgst-rate"></div>
                                                <div class="tax-sgst-amount" id="total-tax-sgst-amount">24.75
                                                </div>
                                            </div>
                                        </td>
                                        <td class="tax-table-info bold" id="total-tax-amount">₹ 49.5</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Amount in words and Misc Details to keep together -->
                            <div class="bottom-content-container">

                                <!-- Amount in words -->
                                <div id="amount-words-container">
                                    <div id="amount-words">
                                        <div id="amount-words-label">Total Amount (in words)</div>
                                        <div id="amount-words-value">{{ strtoupper(getIndianCurrency(3999)) }} ONLY
                                        </div>
                                    </div>

                                </div>



                                <!-- Misc details  -->
                                <div class="misc-details-container">

                                    <!-- Notes -->


                                    <!-- Bank Details -->
                                    <div id="bank-details" class="misc-details">
                                        <div id="bank-details-label"> Bank Details </div>
                                        <div class="bank-details-info">
                                            <div class="bank-details-info-label">Name:</div>
                                            <div id="bank-details-name" class="bank-details-value">SHAMSHER ALI</div>
                                        </div>
                                        <div class="bank-details-info">
                                            <div class="bank-details-info-label">IFSC Code:</div>
                                            <div id="bank-details-ifsc" class="bank-details-value">BARB0CANTTX</div>
                                        </div>
                                        <div class="bank-details-info">
                                            <div class="bank-details-info-label">Account No:</div>
                                            <div id="bank-details-account" class="bank-details-value">57128100000331
                                            </div>
                                        </div>
                                        <div class="bank-details-info">
                                            <div class="bank-details-info-label">Bank:</div>
                                            <div id="bank-details-bank-name" class="bank-details-value">Bank of Baroda
                                                ,CANTT</div>
                                        </div>
                                    </div>

                                    <!-- UPI Details -->


                                    <!-- Terms and conditions -->
                                    <div id="tnc" class="misc-details">
                                        <div id="tnc-label"> Terms and Conditions </div>
                                        <div id="tnc-value">1. Defective product will be replaced.<br>2. Record the
                                            video while opening the packet.</div>
                                    </div>

                                    <!-- Signature -->
                                    <div id="signature" class="misc-details">
                                        <div id="signature-img-container"> <img id="signature-img" src="">
                                        </div>
                                        <div id="signature-label"> Authorised Signatory For</div>
                                        <div id="signatory-name">MERA MART Pre Lunching</div>
                                    </div>
                                </div>

                            </div>

                            <!-- E Invoicing Container -->

                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot id="main-footer">
                <tr>
                    <td>
                        <div class="page-footer-space"></div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Page Footer -->
    <div class="page-footer">
        <!-- Page Branding -->
        <div class="page-branding" id="page-branding-container" style="display: flex">
            <a href="https://mybillbook.sng.link/A1sl1/kmwx/t5ek" target="_blank">
                <img src="">
            </a>
        </div>
    </div>

    <!-- Sentry Lib -->
    <script src="https://browser.sentry-cdn.com/7.24.2/bundle.min.js"
        integrity="sha384-9uapQGwcpfQ0MhBPF9K0kJQcSl6WlSXljCtI/zMwbz8mDaI+FgInHBwR+MNVz+h+" crossorigin="anonymous">
    </script>
    <!-- Init Sentry SDK -->

    <!-- QRCode Lib -->

    <!-- Utils  -->

    <!-- Currency helper -->

    <!-- Helper function that prepare data -->

    <!-- DOM manipulation Helper -->

    <!-- Box themes specific things -->

    <!-- Invoice render file -->
    <style>

    </style>

</body>

</html>
