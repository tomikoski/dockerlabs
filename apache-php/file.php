<?php

    function getCloneResults($fileName) {
        $results = NULL;

        $fileContents = file_get_contents("/xpaths/nc_log/$fileName");

        if ($fileContents) {
            $rows = explode("\n", $fileContents);
            foreach ($rows as $row) {
                $rowParts = explode("=", $row);
                $rowArray["group"] = $rowParts[0];
                $rowArray["result"] = $rowParts[1];
                $results[] = $rowArray;
            }
        }

        return $results;
    }

    $cloneCreateResults = getCloneResults('cloneCreate.txt');
    $cloneInstallResults = getCloneResults('cloneInstall.txt');
    
    // the last element of these array is empty, so pop them off here
    array_pop($cloneCreateResults);
    array_pop($cloneInstallResults);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $determineCharset() ?>">
<!--
    Copyright (c) 2006-2014 Xerox Corporation. All Rights Reserved.

    Copyright protection claimed includes all forms and matters of
    copyrightable material and information now allowed by statutory or
    judicial law or hereinafter granted, including without limitation,
    material generated from the software programs which are displayed
    on the screen such as icons, screen and the like.
-->
    <title>Clone Results</title>
    <style>
        #createResults {
            float: left;
            margin-left: 12px;
        }

        #installResults {
            float: left;
            position: relative;
            left: 20px;
        }

        .tableTitle {
            font-weight: bold;
        }

        #clearBoth {
            clear:both;
        }

        table {
            border-left: solid gray 1px;
            border-bottom: solid gray 1px;
            border-right: solid gray 1px;
        }

        td, th {
            border-top: solid gray 1px;
            padding: 2px 6px;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <h1>Cloning Results</h1>
    <div id=resultsDiv>
        <div id="createResults">
            <span class="tableTitle">Clone Create</span>
            <?php if (is_array($cloneCreateResults)) : ?>
            <table cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cloneCreateResults as $result) : ?>
                    <tr>
                        <td><img src="<?php echo $result["result"] == "Not OK" ? "/images/configured/not.png" : "/images/configured/fully.png" ?>" /></td>
                        <td><?php echo $result["group"]?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php else : ?>
            <br />
            There are currently no results to display for clone creation.
            <?php endif ?>
        </div>
        <div id="installResults">
            <span class="tableTitle">Clone Install</span>
            <?php if (is_array($cloneInstallResults)) : ?>
            <table cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cloneInstallResults as $result) : ?>
                    <tr>
                        <td><img src="<?php echo $result["result"] == "Not OK" ? "/images/configured/not.png" : "/images/configured/fully.png" ?>" /></td>
                        <td><?php echo $result["group"]?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php else : ?>
            <br />
            There are currently no results to display for clone installation.
            <?php endif ?>
        </div>
        <div id="clearBoth"></div>
    </div>

</body>
</html>

