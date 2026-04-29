<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordem de Serviço #{{ $chamado->id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #000; }
        .header p { margin: 0; font-size: 14px; }
        .section { margin-bottom: 20px; border: 1px solid #ccc; padding: 15px; border-radius: 5px; }
        .section h2 { margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 10px; }
        .details-grid { display: block; }
        .detail-item { margin-bottom: 10px; }
        .detail-item strong { display: block; color: #555; font-size: 11px; text-transform: uppercase; }
        .description { background-color: #f9f9f9; padding: 10px; border-radius: 3px; }
        .footer { text-align: center; margin-top: 40px; font-size: 10px; color: #777; }
        .signature { margin-top: 80px; text-align: center; }
        .signature-line { border-top: 1px solid #333; width: 300px; margin: 0 auto; }
        .signature-label { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>InfoCellShop</h1>
            <p>Ordem de Serviço #{{ $chamado->id }}</p>
        </div>

        <div class="section">
            <h2>Detalhes do Chamado</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <strong>Data de Abertura:</strong>
                    <span>{{ $chamado->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="detail-item">
                    <strong>Valor Total:</strong>
                    <span>{{ $chamado->valor_total ? 'R$ ' . number_format($chamado->valor_total, 2, ',', '.') : 'Não definido' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Tipo de Serviço:</strong>
                    <span>{{ $chamado->tipoChamado->nome }}</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Informações do Cliente</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <strong>Nome:</strong>
                    <span>{{ $chamado->cliente->nome }}</span>
                </div>
                <div class="detail-item">
                    <strong>Telefone:</strong>
                    <span>{{ $chamado->cliente->telefone }}</span>
                </div>
                <div class="detail-item">
                    <strong>Email:</strong>
                    <span>{{ $chamado->cliente->email ?? 'Não informado' }}</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Descrição do Problema / Serviço Realizado</h2>
            <p class="description">
                {{ $chamado->descricao }}
            </p>
        </div>

        <div class="signatures-container">
            <div class="signature">
                <div class="signature-line"></div>
                <p class="signature-label">Assinatura do Cliente</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p class="signature-label">Assinatura do Técnico</p>
            </div>
        </div>

        <div class="footer">
            <p>InfoCellShop - Agradecemos a sua preferência!</p>
        </div>
    </div>
</body>
</html>
