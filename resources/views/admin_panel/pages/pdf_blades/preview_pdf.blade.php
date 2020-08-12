<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $assets->company_name }} - Final Report</title>

    <style>
        * {
            box-sizing: border-box;
        }
        html { -webkit-print-color-adjust: exact; }
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Titillium Web", Helvetica, sans-serif;
            background: #999999;
            color: white;
        }

        .container {
            width: 90%;
            height: auto;
            margin: auto;
        }

        .row {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .text-center {
            text-align: center;
        }

        .padding-y {
            padding-bottom: 30px;
        }

        .header-nav {
            background: #5f5f5f;
            height: 100%;
            padding: 20px 0;
        }

        .header-nav ul {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0px;
        }

        .header-nav ul li {
            list-style: none;
        }

        .header-nav ul li a.btn {
            padding: 15px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 3px;
        }

        .header-nav ul li a.btn.backBtn {
            background: #0b81e6ba;
        }

        .header-nav ul li a.btn.downBtn {
            background: #28A745;
        }
        /* header-end */

        .mainContent .brandPage {
            height: 1200px;
            width: 100%;
            background: #0a0a0a;
            text-align: center;
            position: relative;
        }

        .mainContent .brandPage .brand-align {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -70%);
        }

        .mainContent .brandPage .brand-align img {
            width: 450px;
        }

        .mainContent .brandPage .brand-align .brandTitle {
            font-size: 26px;
            color: #fff;
            width: auto;
            margin: -10px 0 0 100px;
        }

        .mainContent .brandPage .footer {
            position: absolute;
            bottom: 5%;
            left: 50%;
            transform: translateX(-50%);
        }

        .mainContent .brandPage .footer a {
            text-decoration: none;
            color: #fff;
            font-size: 20px;
        }

        .mainContent .brandPage .footer a:hover {
            color: aqua;
            transition: 0.5s ease-in-out;
        }

        .mainContent .contentPage {
            background: #fff;
            color: #000;
            height: auto;
            margin: 0;
            padding: 20px;
        }

        .mainContent .contentPage .contentList h2,
        .mainContent .contentPage .contentIntro h2,
        .mainContent .contentPage .contentObject h2,
        .mainContent .contentPage .ClientTable h2,
        .mainContent .contentPage .vulSummary h2,
        .mainContent .contentPage .vulDetails h2 {
            font-size: 30px;
            color: #000;
        }

        .contentList ol {
            margin-left: 40px;
        }

        .contentList ol li {
            padding: 5px;
            font-size: 20px;
        }

        .mainContent .contentPage .contentIntro p,
        .mainContent .contentPage .contentObject p {
            width: 90%;
            margin: 40px auto;
            padding: 20px;
            background: #ddd;
            font-size: 20px;
            line-height: 1.5;
            text-align: center;
            border-radius: 2px;
        }

        .mainContent .contentPage .vulSummary p {
            font-size: 20px;
        }

        .mainContent .contentPage .vulSummary thead tr th {
            padding: 15px;
            font-size: 20px;
            background: #000;
            color: #fff;
            border: 1px solid#000;
        }

        .mainContent .contentPage .vulSummary tbody tr th,
        .mainContent .contentPage .vulSummary tbody tr td {
            padding: 15px;
            border-bottom: 1px solid rgb(187, 186, 186);
            border-right: 1px solid rgb(187, 186, 186);
        }

        .mainContent .contentPage .ClientTable table,
        .mainContent .contentPage .vulSummary table {
            width: 90%;
            border: 1px solid rgb(187, 186, 186);
            border-collapse: collapse;
            margin: auto;
        }

        .mainContent .contentPage .ClientTable table tr {
            border-top: 1px solid rgb(187, 186, 186);
        }

        .mainContent .contentPage .ClientTable table th,
        .mainContent .contentPage .ClientTable table td {
            padding: .75rem;
            vertical-align: top;
            border-right: 1px solid rgb(187, 186, 186);
        }

        .mainContent .contentPage .ClientTable table th {
            background-color: #000;
            color: #fff;
        }

        .mainContent .contentPage .ClientTable table tr td p {
            margin-top: 0px;
        }
        .vulStatus ,
        .bugDetails{
            margin: auto;
            width: 90%;
            position: relative;
        }
        .vulStatus:before{
            content: "";
            position: absolute;
            height: 4px;
            width: 100%;
            background-color: #000;
            top: 0;
            border-radius: 2px 2px 0 0;
        }
        .vulStatus  li {
            padding: 15px;
            font-size: 20px;
        }
        .vulStatus ul {
            list-style: none;
            background: #ddd;
            padding: 20px;
            border-radius: 3px;
        }
        .bugDetails > h2 {
            font-size: 28px;
            color: #151414;
            margin-top: 50px;
        }
        .bugDetails > p {
            font-size: 18px;
            color: #101010;
        }
        .content {
            margin-bottom: 20px;
            border-bottom: 1px solid #d0cdcd47;
        }

        .content:last-child {
            border-bottom: 0;
        }
        .prev-content h2 {
            font-size: 1.5rem;
            color: #333333;
        }
        /* Page Setiing */

        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
                page-break-before: always;
                page-break-inside: auto;
            }
            .padding-y {
                padding-bottom: 0px;
            }
            header.header-nav {
                display: none;
            }
            .mainContent .brandPage {
                background: #0a0a0a;
                height: 950px;
            }
            .mainContent .contentPage .contentIntro h2 {
                margin-top:100px;
            }
            .prev-content h2 {
                margin: 0px !important;
            }
        }
    </style>
</head>
<body>
    <header class="header-nav">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        <a class="btn backBtn" href="{{ route('admin.show', $assets->asset_slug) }}">Back</a>
                    </li>
                    <li>
                        <a class="btn downBtn" href="{{ route('admin.downloadPDF', $assets->asset_slug) }}">Download</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main class="mainContent">
        <div class="container">
            <div class="row">
                <section class="brandPage">
                    <div class="brand-align">
                        <img src="{{ asset('admin_panel/assets/img/logo/White.png') }}" alt="pentester-logo">
                        <p class="brandTitle">Penetration Test Report</p>
                    </div>
                    <div class="footer">
                        <a href="#">www.pentesterspace.com</a> |
                        <a href="#">support@pentester.com</a>
                    </div>
                </section>
                <!-- <div class="pagebreak"> </div>    pagebreak -->
                <div class="contentPage">
                    <section class="contentTable">
                        <div class="contentList padding-y">
                            <h2 class="text-center">Table of Contents</h2>
                            <ol>
                                <li>Introduction</li>
                                <li>Project Objective</li>
                                <li>Client information</li>
                                <li>Scope</li>
                                <li>Security Threat Level</li>
                                <li>Summary of Vulnerabilities</li>
                            </ol>
                        </div>
                        <div class="contentIntro padding-y">
                            <h2 class="text-center">Introduction</h2>
                            <p>We at Hackersray carried out a penetration test for JudgeMe web applications & JudgeMe API. This report contains our findings as well as detailed explanations of vulnerabilities that were identified along with their patches
                                and risks.
                            </p>
                        </div>
                        <div class="contentObject padding-y"  style="page-break-before:always">
                            <h2 class="text-center">Project Objective</h2>
                            <p>The project objective was to identify vulnerabilities in the JudgeMe applications and the JudgeMe API. This was achieved by performing penetration tests against the web applications of JudgeMe as well as the API that was being
                                used by the application.
                            </p>
                        </div>
                        <!-- <div class="pagebreak"> </div>    pagebreak -->
                        <div class="ClientTable padding-y text-center">
                            <h2>Client information and Scope</h2>
                            <table>
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="background-color: #fff; color: #000;">Penetration Test Report</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Client</th>
                                    <td>{{ $assets->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Targets</th>
                                    <td>
                                        @foreach($inScopeUrls as $inScopeUrl)
                                        <p>{{ change_http($inScopeUrl->value) }}</p>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pentesters</th>
                                    <td>
                                        @foreach($users as $user)
                                            {{ $loop->first ? '' : ',' }}
                                            {{ $user->name }}
                                            {{ $loop->last ? '.' : '' }}
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="vulSummary padding-y text-center" style="page-break-before:always">
                            <h2>Summary Of Vulnerabilities</h2>
                            <table>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Threat Level</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <th>{{ $report->id }}</th>
                                    <th style="max-width: 450px;">{{ $report->bug_name }}</th>
                                    <td style="width:150px;">
                                        @if(empty($report->severity))
                                            {{ $report->severity_calc }}
                                        @else
                                            {{ $report->severity }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    @foreach($reports as $report)
                    <div class="vulDetails" style="page-break-before:always">
                        <h2 class="text-center padding-y">Vulnerabilities in Detail</h2>
                        <div class="vulStatus">
                            <ul>
                                <li>ID : <span>{{ $report->id }}</span> </li>
                                <li>Weakness :
                                    @if(empty($report->weakness))
                                        <span>{{ $report->otherWeakness }}</span>
                                    @else
                                        <span>{{ $report->weakness }}</span>
                                    @endif
                                </li>
                                <li>Threat level :
                                    @if(empty($report->severity))
                                        <span>{{ $report->severity_calc }}</span>
                                    @else
                                        <span>{{ $report->severity }}</span>
                                    @endif
                                </li>
                                <li>Vulnerability Title : <span>{{ $report->bug_name }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <section class="bugDetails">
                        <div class="content">
                            <h2>Description</h2>
                            <div class="prev-content">
                                {!! $data['desc'] !!}
                            </div>
                        </div>
                        <!-- descrip end -->
                        <div class="content" style="page-break-before:always">
                            <h2>Impact</h2>
                            <div class="prev-content">
                                {!! $data['impact'] !!}
                            </div>
                        </div>
                        <!-- impact end -->
                        <div class="content" style="page-break-before:always">
                            <h2>Step of Reproduce</h2>
                            <div class="prev-content">
                                {!! $data['steps_of_reproduce'] !!}
                            </div>
                        </div>
                        <!-- reproduce end -->
                        <div class="content" style="page-break-before:always">
                            <h2>Exploitation</h2>
                            <div class="prev-content">
                                {!! $data['exploitation'] !!}
                            </div>
                        </div>
                        <!-- exploitation end -->
                        <div class="content" style="page-break-before:always">
                            <h2>Fixation</h2>
                            <div class="prev-content">
                                {!! $data['fixation'] !!}
                            </div>
                        </div>
                        <!-- fixation end -->
                    </section>
                    @endforeach
                </div>

            </div>
        </div>
    </main>
</body>
</html>
