<?php

$methodName = "none";


function setPaperSize($trayId, $xdim, $ydim, $color, $type)
{
    //require_once('php_includes/systemModification.inc');
          
    $status = $setPaperSize($trayId, $xdim, $ydim, "0", "0");
    
    $returnData = array(
        "status" => $status,
    );

    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function getMediumSizeList($trayId)
{
    //require_once('php_includes/systemModification.inc');

    $list = $getMediumSizeList($trayId);

    header('Content-type: application/json');
    
    $myArray = explode(",", $list);
    
    if (count($myArray) == 1)
    {
        $returnData = array(
            "status" => $myArray[0],
        );
    }
    else 
    {    
        $returnData[$myArray[0]] = $myArray[1];
        $count = 1;
        
        for ($i = 2; $i < count($myArray);) {
            $data[$myArray[$i]] = $myArray[$i + 1];
            $data[$myArray[$i + 2]] = $myArray[$i + 3];
                
            $returnData["mediumSize" . $count] = $data;
            $i = $i + 4;
            $count = $count + 1;
            unset($data);
        }
    }
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function wakeUp()
{
    //require_once('php_includes/systemModification.inc');

    $wakeUpDevice();

    $returnData = array(
        "status" => "success",
    );
    
    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function setSystemBusy()
{
    //require_once('php_includes/systemModification.inc');
          
    $setSystemBusy();
    
    $returnData = array(
        "status" => "success",
    );

    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function setSystemIdle()
{
    //require_once('php_includes/systemModification.inc');
          
    $setSystemIdle();
    
    $returnData = array(
        "status" => "success",
    );

    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function rebootDevice()
{
    //require_once('php_includes/systemModification.inc');
    
    $rebootDevice();

    $returnData = array(
        "status" => "success",
    );
    
    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function powerOffDevice()
{
    //require_once('php_includes/systemModification.inc');

    $powerOffDevice();

    $returnData = array(
            "status" => "success",
    );
    
    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function getEnergySaverMode()
{
    //require_once('php_includes/systemConfiguration.inc');

    $esMode = $getStringConfigAttribute("deviceAdmin.powerSaver.intelligentReady.mode");

    $returnData = array(
        "Energy Saver Mode" => $esMode,
    );
    
    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function pushLogs()
{
    //require_once('php_includes/systemModification.inc');
    //require_once('php_includes/systemConfiguration.inc');

    $setConfigAttribute("webServices.supportDLMs[edgeCli].webLogPushRequest", "TRUE", "UI");

    header('Content-type: application/json');

    if($getBooleanConfigAttribute("webServices.supportDLMs[edgeCli].webLogPushRequest")) {
        $returnData = array(
            "status" => "success",
        );
    }
    else {
        $returnData = array(
            "status" => "failed",
        );
    }
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function uploadLogFile()
{
    $tabletLogFile = $_FILES["FILENAME"]["name"];
    
    // put file in directory that contains the documents
    move_uploaded_file($_FILES["FILENAME"]["tmp_name"], "/xpaths/nc_log/" . $tabletLogFile);
    
    if ($_FILES['FILENAME']['error'] === 0)
    {
        $returnData = array(
            "status" => "success",
        );
    }
    else
    {
        $returnData = array(
            "status" => "failure",
        );
    }

    header('Content-type: application/json');

    // do processing, passing in relevant data
    echo json_encode($returnData);
}


function uiTouched()
{
    //require_once('php_includes/systemModification.inc');    
    
    //shell_exec("/xpaths/nc_root//bin/keepAlive.sh");
    $uiTouched();
    
    $returnData = array(
        "status" => "success",
    );

    header('Content-type: application/json');
    
    // do processing, passing in relevant data
    echo json_encode($returnData);
}


//==============================================================================
// main, handle requests.
//==============================================================================
if (isset($_POST['method']) )
{
    $methodName = $_POST['method'];
}
else if( isset($_GET['method']) )
{
    $methodName = $_GET['method'];
}


//==============================================================================
// if the IP is NOT from tablet interface, drops through, don't even response.
//==============================================================================
if ($_SERVER['HTTP_HOST'] != "192.168.42.107")
{
    // do nothing, return no data (in case of phishing)
}
else if ($methodName == "setPaperTrayAttributes")
{
    if( isset($_GET['trayId']) )
        $trayId = $_GET['trayId'];
    else $error = true;
        
    if( isset($_GET['xdim']) )
        $xDim = $_GET['xdim'];
    else $error = true;
    
    if( isset($_GET['ydim']) )
        $yDim = $_GET['ydim'];
    else $error = true;
    
    if( isset($_GET['color']) )
        $color = $_GET['color'];
    else $error = true;
    
    if( isset($_GET['type']) )
        $type = $_GET['type'];
    else $error = true;
    
    if ($error)
    {
        $returnData = array(
            "status" => "invalid parameters in call",
        );
        
        header('Content-type: application/json');
        
        // do processing, passing in relevant data
        echo json_encode($returnData);
    }
    else
    {
        setPaperSize($trayId, $xDim, $yDim, $color, $type);
    }
}
else if ($methodName == "getMediumSizeList")
{
    if( isset($_GET['trayId']) )
        $trayId = $_GET['trayId'];
    else $error = true;

    if ($error)
    {
        $returnData = array(
            "status" => "invalid parameters in call",
        );
    
        header('Content-type: application/json');
    
        // do processing, passing in relevant data
        echo json_encode($returnData);
    }
    else
    {
        getMediumSizeList($trayId);
    }
}
else if ($methodName == "wakeUp")
{
    wakeUp();
}
else if ($methodName == "goToSleep")
{
    enterLowPowerMode();
}
else if ($methodName == "setSystemBusy")
{
    setSystemBusy();
}
else if ($methodName == "setSystemIdle")
{
    setSystemIdle();
}
else if ($methodName == "reboot")
{
    rebootDevice();
}
else if ($methodName == "powerOff" )
{
    powerOffDevice();
}
else if ($methodName == "getEnergySaverMode")
{
    getEnergySaverMode();
}
else if ($methodName == "pushLogs")
{
    pushLogs();
}
else if ($methodName == "uploadLogFile")
{    
    uploadLogFile();
}
else if ($methodName == "uiTouched")
{    
    uiTouched();
}
else
{
    $returnData = array(
        "status" => "invalid url format",
    );

    header('Content-type: application/json');

    // do processing, passing in relevant data
    echo json_encode($returnData);
}

?>

