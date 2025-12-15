<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background-color: #ffffff; padding: 20px; border-radius: 8px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #2d3748; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #4a5568; color: #ffffff; padding: 10px; text-align: left; }
        td { border-bottom: 1px solid #e2e8f0; padding: 10px; color: #4a5568; }
        .footer { margin-top: 20px; font-size: 0.8em; color: #718096; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, {{ $arbitre->name }} 👋</h1>
        <p>Aquestes són les teves pròximes assignacions arbitrals:</p>

        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Partit</th>
                    <th>Estadi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partits as $partit)
                <tr>
                    <td>{{ $partit->data->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $partit->equipLocal->nom }}</strong> <br>
                        vs <br>
                        <strong>{{ $partit->equipVisitant->nom }}</strong>
                    </td>
                    <td>{{ $partit->estadi->nom }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Si tens algun problema amb aquestes assignacions, contacta amb l'administració.</p>
        
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>