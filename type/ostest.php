<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>無標題文件</title>
    <style>
        body {
            font-family: "Microsoft JhengHei", Arial, sans-serif;
            margin: 2.54cm 3.18cm;
            padding: 0;
            width: 42cm;
            height: 29.7cm;
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            height: 100%;
            border: 5px solid red;
            margin: 5px;
            text-align: center;
        }

        td {
            border: 1px solid red;
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-size: 12px;
            line-height: 1.4;
            text-align: center;
            vertical-align: middle;
            position: relative;
        }

        td:nth-child(10) {
            width: 3%;
        }

        img {
            width: 100%;
            height: auto;
            max-height: 100%;
        }

        td:not(:nth-child(10)) {
            width: 4%;
        }

        /* Add custom styles for vertical text */
        .vertical-text {
            writing-mode: vertical-rl;
            max-width: 4%;
            max-height: 4%;
        }

        /* 在适当的位置添加以下样式以移除上下线条和中间的线条 */
        td.no-border {
            border-top: none;
            border-bottom: none;
            border-right: none;
        }

        /* 在适当的位置添加以下样式以移除左边的线条 */
        td.no-border-left {
            border-left: none;
            border-top: none;
            border-bottom: none;
        }

        /* 在适当的位置添加以下样式以移除上下线条和中间的线条 */
        td.no-border-top-bottom {
            border-top: none;
            border-bottom: none;
        }

        /* 移除合并单元格上下线条和中间的线条 */
        td.no-border-top-bottom {
            border-top: none;
            border-bottom: none;
        }

        /* 移除合并单元格上面的线条 */
        td.no-border-top {
            border-top: none;
        }

        /* 移除合并单元格下面的线条 */
        td.no-border-bottom {
            border-bottom: none;
        }

        /* 添加一个新样式来增大族谱名的字号 */
        .zupuming {
            font-size: 16px;
        }

        /* 添加一个新样式来增大彭城堂的字号 */
        .pengchengtang {
            font-size: 16px;
        }

        /* 添加一个新样式来增大世代字号 */
        .shidai {
            font-size: 16px;
        }

        /* Adjust the width of the entire tenth column */
        .tenth-column {
            width: 2%;
        }
    </style>
</head>
<body>
    <table width="95%" height="800" border="5" align="center">
        <tbody>
            <tr>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    echo '<td class="vertical-text">&nbsp;</td>';
                }
                ?>
                <td colspan="2" align="center" valign="middle" class="vertical-text zupuming tenth-column"><h1>劉氏族譜</h1></td>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    echo '<td class="vertical-text">&nbsp;</td>';
                }
                ?>
            </tr>
            <tr>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    echo '<td class="vertical-text">&nbsp;</td>';
                }
                ?>
                <!-- 第一个td元素 -->
                <td colspan="2" class="vertical-text no-border-top-bottom tenth-column" style="max-width: 2%; max-height:1.4%; vertical-align: top;">
                    <img src="/type/fishs.png" width="100%" height="100%" alt=""/>
                </td>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    echo '<td class="vertical-text">&nbsp;</td>';
                }
                ?>
            </tr>
            <tr>
                <?php
                for ($i = 0; $i <9; $i++) {
                    echo '<td class="vertical-text" rowspan="4">&nbsp;</td>';
                }
                ?>
                <td class="vertical-text no-border shidai tenth-column" style="max-width: 0.5%; max-height:8%;">XX世至XX世代&emsp;&emsp;&emsp;&emsp;XX頁</td>
                <td class="vertical-text no-border-left shidai tenth-column" style="max-width:0.5%; max-height:8%;">XX世至XX世代&emsp;&emsp;&emsp;&emsp;     XX頁</td>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    echo '<td class="vertical-text" rowspan="4">&nbsp;</td>';
                }
                ?>
            </tr>
            <tr>
                <!-- 第二个td元素 -->
                <td class="vertical-text no-border-top no-border-bottom tenth-column" colspan="2" style="max-width: 2%; max-height:1%; vertical-align: bottom;">
                    <img src="/type/fishx.png" width="100%" height="100%" alt=""/>
                </td>
            </tr>
            <tr>
                <td class="vertical-text pengchengtang tenth-column" colspan="2">彭城堂</td>
            </tr>
        </tbody>
    </table>
</body>
</html> 