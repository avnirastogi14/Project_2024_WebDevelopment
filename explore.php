    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Search - Travel Vista</title>
        <link rel="stylesheet" href="ex_style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&family=Brush+Script+MT&display=swap" rel="stylesheet">
        <style>
            h1
            {
                font-family:"Brush Script MT", cursive;
            }
            body {
                margin: 0;
                padding: 0;
                background-color: #f0f8ff;
                color: #333;
            }

            header {
                background-color: #005f73;
                color: white;
                text-align: center;
                padding: 20px 0;
            }

            h1 {
                margin: 0;
                font-size: 2.5em;
            }

            main {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            form
            {
                align-items:center;
            }

            h2 {
                text-align: center;
                color: #005f73;
                margin-bottom: 20px;
            }

            form {
                display: flex;
                flex-direction: column;
            }

            label {
                margin-bottom: 5px;
                font-weight: bold;
            }

            select {
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1em;
            }

            button {
                padding: 10px;
                background-color: #005f73;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 1em;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #004d61;
            }

            footer {
                text-align: center;
                padding: 20px 0;
                background-color: #005f73;
                color: white;
                position: relative;
                bottom: 0;
                width: 100%;
            }

            p {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Travel Vista</h1>
        </header>
        <main>
            <h2>Find Hotels in Your City</h2>
            <form action="fetch_hotels.php" method="POST">
    <div class="form-container">
        <label for="city">Choose a city:</label>
        <select name="city" id="city" required>
            <option value="">Select a city</option>
            <option value="New York">New York</option>
            <option value="Los Angeles">Los Angeles</option>
            <option value="Chicago">Chicago</option>
            <option value="Miami">Miami</option>
            <option value="San Francisco">San Francisco</option>
        </select>
    </div>
    <button type="submit">Search Hotels</button>
</form>
        </main>
        <footer>
            <p>&copy; 2024 Travel Vista. All Rights Reserved.</p>
        </footer>
    </body>
    </html>