# DBRaw.php API Documentation

This API provides HTTP endpoints for setting and getting global variables through simple HTTP requests.

## Available Endpoints

### Set Individual Variables

1. **Set Cookie Account**
   ```
   GET /dbraw.php?func=setGlobalCookieAccount&cookieValue=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m
   ```

2. **Set Save Hash**
   ```
   GET /dbraw.php?func=setGlobalSaveHash&saveHashValue=4c2b7049d122a954057945fb30ed8a46fb59
   ```

3. **Set Page ID**
   ```
   GET /dbraw.php?func=setGlobalPageId&pageIdValue=0c7c6f976bbb536f4506e
   ```

4. **Set String Content**
   ```
   GET /dbraw.php?func=setGlobalStringContent&contentValue=example_content
   ```

5. **Set Linkpool**
   ```
   GET /dbraw.php?func=setGlobalLinkpool&linkpoolValue=example_linkpool
   ```

### Set All Variables at Once

```
GET /dbraw.php?func=setAllGlobalVars&cookieAccount=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m&saveHash=4c2b7049d122a954057945fb30ed8a46fb59&pageId=0c7c6f976bbb536f4506e&stringContent=example&linkpool=example
```

### Get All Variables

```
GET /dbraw.php?func=getGlobalVars
```

### API Documentation

```
GET /dbraw.php
```

## Response Format

All responses are returned in JSON format:

### Success Response
```json
{
  "status": "success",
  "message": "Operation completed successfully",
  "value": "set_value"
}
```

### Error Response
```json
{
  "status": "error",
  "message": "Error description"
}
```

### Get Variables Response
```json
{
  "status": "success",
  "data": {
    "cookieasaccount": "value1",
    "save_hash": "value2",
    "page_id": "value3",
    "all_string_content": "value4",
    "linkpool": "value5"
  }
}
```

## Security Features

- Input validation and sanitization
- Length limits on all parameters
- HTML entity encoding to prevent XSS
- Function whitelist to prevent unauthorized access
- Error handling for invalid requests

## Usage Examples

### Using cURL

```bash
# Set cookie account
curl "http://your-server/dbraw.php?func=setGlobalCookieAccount&cookieValue=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m"

# Get all variables
curl "http://your-server/dbraw.php?func=getGlobalVars"

# Set all variables at once
curl "http://your-server/dbraw.php?func=setAllGlobalVars&cookieAccount=test&saveHash=hash&pageId=id&stringContent=content&linkpool=pool"
```

### Using JavaScript (AJAX)

```javascript
// Set a single variable
fetch('/dbraw.php?func=setGlobalCookieAccount&cookieValue=AMBhjsvgPRNYN3Ydi1Gf715gWWr0Rg3r1FHk5aBT1m')
  .then(response => response.json())
  .then(data => console.log(data));

// Get all variables
fetch('/dbraw.php?func=getGlobalVars')
  .then(response => response.json())
  .then(data => console.log(data));
```

## Notes

- The API supports both GET and POST requests
- Global variables are session-specific and don't persist between different HTTP requests in a stateless environment
- All responses include CORS headers for cross-origin requests
- The API is backward compatible and doesn't interfere with existing functionality