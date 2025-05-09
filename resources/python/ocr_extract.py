import pytesseract
from PIL import Image
import sys
import json

try:
    # Configure Tesseract path (update this to your actual path)
    pytesseract.pytesseract.tesseract_cmd = r'C:\Users\hp\AppData\Local\Programs\Tesseract-OCR\tesseract.exe'

    # Get image path from command line argument
    if len(sys.argv) < 2:
        print(json.dumps({"error": "No image path provided"}))
        sys.exit(1)
        
    image_path = sys.argv[1]
    
    # Open the image
    try:
        img = Image.open(image_path)
    except Exception as e:
        print(json.dumps({"error": f"Image opening error: {str(e)}"}))
        sys.exit(1)
    
    # Extract text
    text = pytesseract.image_to_string(img, lang='fra')
    
    # Return result as JSON
    print(json.dumps({
        "success": True,
        "text": text.strip(),
        "image_path": image_path
    }))
    
except Exception as e:
    print(json.dumps({
        "success": False,
        "error": f"General error: {str(e)}",
        "traceback": str(sys.exc_info())
    }))
    sys.exit(1)