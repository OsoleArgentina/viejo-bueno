<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:nth-child(odd) {
            background-color: #ffffff;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .product-image {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .info-table td {
            color: #555;
            font-size: 14px;
        }
        .info-table td strong {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Informacion del contacto</h1>
        
        <table class="info-table">
            <tbody>
                <tr>
                    <td><strong>Nombre y Apellido</strong></td>
                    <td>{{ $data['nombre'] }}</td>
                </tr>
                <tr>
                    <td><strong>Correo</strong></td>
                    <td>{{ $data['correo'] }}</td>
                </tr>
                <tr>
                    <td><strong>Telefono</strong></td>
                    <td>{{ $data['telefono'] }}</td>
                </tr>
                <tr>
                    <td><strong>Empresa</strong></td>
                    <td>{{ $data['empresa'] }}</td>
                </tr>
                <tr>
                    <td><strong>Mensaje</strong></td>
                    <td>{{ $data['mensaje'] ?? '' }}</td>
                </tr>
            </tbody>
        </table>

</body>
</html>
