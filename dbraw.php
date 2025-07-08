<?php
/**
 * Global Variables HTTP API
 * Provides HTTP endpoints for setting and getting global variables
 */

// Global variables
$cookieasaccount = '';
$save_hash = '';
$page_id = '';
$all_string_content = '';
$linkpool = '';

// Whitelisted functions that can be called via API
$dbfunctions = array(
    'setGlobalCookieAccount',
    'setGlobalSaveHash',
    'setGlobalPageId',
    'setGlobalStringContent',
    'setGlobalLinkpool',
    'setAllGlobalVars',
    'getGlobalVars'
);

// API endpoints documentation
$api_endpoints = array(
    'setGlobalCookieAccount' => array(
        'description' => 'Set the global cookie account value',
        'parameters' => array('cookieValue' => 'string - The cookie account value'),
        'example' => 'dbraw.php?func=setGlobalCookieAccount&cookieValue=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m'
    ),
    'setGlobalSaveHash' => array(
        'description' => 'Set the global save hash value',
        'parameters' => array('saveHashValue' => 'string - The save hash value'),
        'example' => 'dbraw.php?func=setGlobalSaveHash&saveHashValue=4c2b7049d122a954057945fb30ed8a46fb59'
    ),
    'setGlobalPageId' => array(
        'description' => 'Set the global page ID value',
        'parameters' => array('pageIdValue' => 'string - The page ID value'),
        'example' => 'dbraw.php?func=setGlobalPageId&pageIdValue=0c7c6f976bbb536f4506e'
    ),
    'setGlobalStringContent' => array(
        'description' => 'Set the global string content value',
        'parameters' => array('contentValue' => 'string - The string content value'),
        'example' => 'dbraw.php?func=setGlobalStringContent&contentValue=example_content'
    ),
    'setGlobalLinkpool' => array(
        'description' => 'Set the global linkpool value',
        'parameters' => array('linkpoolValue' => 'string - The linkpool value'),
        'example' => 'dbraw.php?func=setGlobalLinkpool&linkpoolValue=example_linkpool'
    ),
    'setAllGlobalVars' => array(
        'description' => 'Set all global variables at once',
        'parameters' => array(
            'cookieAccount' => 'string - The cookie account value',
            'saveHash' => 'string - The save hash value',
            'pageId' => 'string - The page ID value',
            'stringContent' => 'string - The string content value',
            'linkpool' => 'string - The linkpool value'
        ),
        'example' => 'dbraw.php?func=setAllGlobalVars&cookieAccount=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m&saveHash=4c2b7049d122a954057945fb30ed8a46fb59&pageId=0c7c6f976bbb536f4506e&stringContent=example&linkpool=example'
    ),
    'getGlobalVars' => array(
        'description' => 'Get all current global variable values',
        'parameters' => array(),
        'example' => 'dbraw.php?func=getGlobalVars'
    )
);

/**
 * Validate and sanitize input string
 * @param string $input The input string to validate
 * @param int $maxLength Maximum allowed length
 * @return string|false Sanitized string or false if invalid
 */
function validateInput($input, $maxLength = 255) {
    if (!is_string($input)) {
        return false;
    }
    
    // Trim whitespace
    $input = trim($input);
    
    // Check length
    if (strlen($input) > $maxLength) {
        return false;
    }
    
    // Basic sanitization - remove potentially harmful characters
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    return $input;
}

/**
 * Set global cookie account value
 * @param string $cookieValue The cookie value to set
 * @return array Response array
 */
function setGlobalCookieAccount($cookieValue) {
    global $cookieasaccount;
    
    $validated = validateInput($cookieValue, 512);
    if ($validated === false) {
        return array('status' => 'error', 'message' => 'Invalid cookie value provided');
    }
    
    $cookieasaccount = $validated;
    return array('status' => 'success', 'message' => 'Cookie account set successfully', 'value' => $cookieasaccount);
}

/**
 * Set global save hash value
 * @param string $saveHashValue The save hash value to set
 * @return array Response array
 */
function setGlobalSaveHash($saveHashValue) {
    global $save_hash;
    
    $validated = validateInput($saveHashValue, 256);
    if ($validated === false) {
        return array('status' => 'error', 'message' => 'Invalid save hash value provided');
    }
    
    $save_hash = $validated;
    return array('status' => 'success', 'message' => 'Save hash set successfully', 'value' => $save_hash);
}

/**
 * Set global page ID value
 * @param string $pageIdValue The page ID value to set
 * @return array Response array
 */
function setGlobalPageId($pageIdValue) {
    global $page_id;
    
    $validated = validateInput($pageIdValue, 128);
    if ($validated === false) {
        return array('status' => 'error', 'message' => 'Invalid page ID value provided');
    }
    
    $page_id = $validated;
    return array('status' => 'success', 'message' => 'Page ID set successfully', 'value' => $page_id);
}

/**
 * Set global string content value
 * @param string $contentValue The string content value to set
 * @return array Response array
 */
function setGlobalStringContent($contentValue) {
    global $all_string_content;
    
    $validated = validateInput($contentValue, 2048);
    if ($validated === false) {
        return array('status' => 'error', 'message' => 'Invalid string content value provided');
    }
    
    $all_string_content = $validated;
    return array('status' => 'success', 'message' => 'String content set successfully', 'value' => $all_string_content);
}

/**
 * Set global linkpool value
 * @param string $linkpoolValue The linkpool value to set
 * @return array Response array
 */
function setGlobalLinkpool($linkpoolValue) {
    global $linkpool;
    
    $validated = validateInput($linkpoolValue, 1024);
    if ($validated === false) {
        return array('status' => 'error', 'message' => 'Invalid linkpool value provided');
    }
    
    $linkpool = $validated;
    return array('status' => 'success', 'message' => 'Linkpool set successfully', 'value' => $linkpool);
}

/**
 * Set all global variables at once
 * @param string $cookieAccount Cookie account value
 * @param string $saveHash Save hash value
 * @param string $pageId Page ID value
 * @param string $stringContent String content value
 * @param string $linkpoolValue Linkpool value
 * @return array Response array
 */
function setAllGlobalVars($cookieAccount, $saveHash, $pageId, $stringContent, $linkpoolValue) {
    $results = array();
    
    // Set each variable and collect results
    $results['cookieAccount'] = setGlobalCookieAccount($cookieAccount);
    $results['saveHash'] = setGlobalSaveHash($saveHash);
    $results['pageId'] = setGlobalPageId($pageId);
    $results['stringContent'] = setGlobalStringContent($stringContent);
    $results['linkpool'] = setGlobalLinkpool($linkpoolValue);
    
    // Check if all operations were successful
    $allSuccess = true;
    foreach ($results as $result) {
        if ($result['status'] !== 'success') {
            $allSuccess = false;
            break;
        }
    }
    
    return array(
        'status' => $allSuccess ? 'success' : 'partial_success',
        'message' => $allSuccess ? 'All global variables set successfully' : 'Some global variables failed to set',
        'results' => $results
    );
}

/**
 * Get all current global variable values
 * @return array Response array with all global variables
 */
function getGlobalVars() {
    global $cookieasaccount, $save_hash, $page_id, $all_string_content, $linkpool;
    
    return array(
        'status' => 'success',
        'data' => array(
            'cookieasaccount' => $cookieasaccount,
            'save_hash' => $save_hash,
            'page_id' => $page_id,
            'all_string_content' => $all_string_content,
            'linkpool' => $linkpool
        )
    );
}

/**
 * Handle API requests
 */
function handleRequest() {
    global $dbfunctions, $api_endpoints;
    
    // Set content type to JSON
    header('Content-Type: application/json');
    
    // Handle CORS if needed
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Content-Type');
    
    // Get function name from request
    $func = isset($_GET['func']) ? $_GET['func'] : (isset($_POST['func']) ? $_POST['func'] : '');
    
    if (empty($func)) {
        // Show API documentation if no function specified
        echo json_encode(array(
            'status' => 'info',
            'message' => 'Global Variables HTTP API',
            'available_functions' => $dbfunctions,
            'endpoints' => $api_endpoints
        ), JSON_PRETTY_PRINT);
        return;
    }
    
    // Check if function is whitelisted
    if (!in_array($func, $dbfunctions)) {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Function not allowed or does not exist',
            'available_functions' => $dbfunctions
        ));
        return;
    }
    
    // Check if function exists
    if (!function_exists($func)) {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Function does not exist'
        ));
        return;
    }
    
    try {
        // Call the function based on its parameters
        switch ($func) {
            case 'setGlobalCookieAccount':
                $cookieValue = isset($_GET['cookieValue']) ? $_GET['cookieValue'] : (isset($_POST['cookieValue']) ? $_POST['cookieValue'] : '');
                $result = setGlobalCookieAccount($cookieValue);
                break;
                
            case 'setGlobalSaveHash':
                $saveHashValue = isset($_GET['saveHashValue']) ? $_GET['saveHashValue'] : (isset($_POST['saveHashValue']) ? $_POST['saveHashValue'] : '');
                $result = setGlobalSaveHash($saveHashValue);
                break;
                
            case 'setGlobalPageId':
                $pageIdValue = isset($_GET['pageIdValue']) ? $_GET['pageIdValue'] : (isset($_POST['pageIdValue']) ? $_POST['pageIdValue'] : '');
                $result = setGlobalPageId($pageIdValue);
                break;
                
            case 'setGlobalStringContent':
                $contentValue = isset($_GET['contentValue']) ? $_GET['contentValue'] : (isset($_POST['contentValue']) ? $_POST['contentValue'] : '');
                $result = setGlobalStringContent($contentValue);
                break;
                
            case 'setGlobalLinkpool':
                $linkpoolValue = isset($_GET['linkpoolValue']) ? $_GET['linkpoolValue'] : (isset($_POST['linkpoolValue']) ? $_POST['linkpoolValue'] : '');
                $result = setGlobalLinkpool($linkpoolValue);
                break;
                
            case 'setAllGlobalVars':
                $cookieAccount = isset($_GET['cookieAccount']) ? $_GET['cookieAccount'] : (isset($_POST['cookieAccount']) ? $_POST['cookieAccount'] : '');
                $saveHash = isset($_GET['saveHash']) ? $_GET['saveHash'] : (isset($_POST['saveHash']) ? $_POST['saveHash'] : '');
                $pageId = isset($_GET['pageId']) ? $_GET['pageId'] : (isset($_POST['pageId']) ? $_POST['pageId'] : '');
                $stringContent = isset($_GET['stringContent']) ? $_GET['stringContent'] : (isset($_POST['stringContent']) ? $_POST['stringContent'] : '');
                $linkpoolValue = isset($_GET['linkpool']) ? $_GET['linkpool'] : (isset($_POST['linkpool']) ? $_POST['linkpool'] : '');
                $result = setAllGlobalVars($cookieAccount, $saveHash, $pageId, $stringContent, $linkpoolValue);
                break;
                
            case 'getGlobalVars':
                $result = getGlobalVars();
                break;
                
            default:
                $result = array('status' => 'error', 'message' => 'Unknown function');
                break;
        }
        
        echo json_encode($result, JSON_PRETTY_PRINT);
        
    } catch (Exception $e) {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Error executing function: ' . $e->getMessage()
        ));
    }
}

// Handle the request if this file is accessed directly
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    handleRequest();
}

?>