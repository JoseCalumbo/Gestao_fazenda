<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha da Cooperativa</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #fff;
            color: #1C2B1E;
            padding: 30px;
        }
        .ficha-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            background: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #2E7D32;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .header .titulo {
            font-size: 22px;
            font-weight: 700;
            color: #2E7D32;
        }
        .header .subtitulo {
            font-size: 12px;
            color: #8FA894;
        }
        .header .numero {
            font-size: 14px;
            color: #8FA894;
            text-align: right;
        }
        .header .numero strong {
            font-size: 18px;
            color: #1C2B1E;
        }
        .secao {
            margin-bottom: 20px;
        }
        .secao-titulo {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #2E7D32;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .campo {
            background: #FAFBFA;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 8px 12px;
        }
        .campo .label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8FA894;
        }
        .campo .valor {
            font-size: 14px;
            font-weight: 500;
            color: #1C2B1E;
            margin-top: 2px;
        }
        .campo-full {
            grid-column: 1 / -1;
        }
        .membros-tabela {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }
        .membros-tabela th {
            background: #FAFBFA;
            font-size: 11px;
            text-transform: uppercase;
            color: #8FA894;
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        .membros-tabela td {
            padding: 6px 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        .rodape {
            margin-top: 30px;
            padding-top: 16px;
            border-top: 1px solid #e0e0e0;
            font-size: 11px;
            color: #8FA894;
            text-align: center;
        }
        .badge {
            display: inline-block;
            background: #E8F5E9;
            color: #2E7D32;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 12px;
            border-radius: 20px;
        }
        .badge.inactiva { background: #FFEBEE; color: #C62828; }
        .badge.pendente { background: #FFF8E1; color: #F57F17; }
        .logo-img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }
        @media print {
            body { padding: 10px; }
            .ficha-container { border: none; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="ficha-container">
        <!-- Cabeçalho -->
        <div class="header">
            <div>
                <div class="titulo">{{ $cooperativa->nome }}</div>
                <div class="subtitulo">Sistema Integrado de Apoio à Gestão Agrícola – SIAG</div>
                <span class="badge {{ $cooperativa->estado }}">{{ ucfirst($cooperativa->estado) }}</span>
            </div>
            <div class="numero">
                <strong>#{{ str_pad($cooperativa->id, 6, '0', STR_PAD_LEFT) }}</strong><br>
                <span style="font-size:12px;">Emissão: {{ now()->format('d/m/Y H:i') }}</span>
                <div style="margin-top:6px; font-size:12px;">NIF: {{ $cooperativa->nif }}</div>
            </div>
        </div>

        <!-- Identificação -->
        <div class="secao">
            <div class="secao-titulo">Identificação</div>
            <div class="grid">
                <div class="campo">
                    <div class="label">Nome Completo</div>
                    <div class="valor">{{ $cooperativa->nome }}</div>
                </div>
                <div class="campo">
                    <div class="label">NIF / Registo</div>
                    <div class="valor">{{ $cooperativa->nif }}</div>
                </div>
                <div class="campo">
                    <div class="label">Data de Fundação</div>
                    <div class="valor">{{ $cooperativa->data_fundacao ? $cooperativa->data_fundacao->format('d/m/Y') : '—' }}</div>
                </div>
                <div class="campo">
                    <div class="label">Estado</div>
                    <div class="valor">{{ ucfirst($cooperativa->estado) }}</div>
                </div>
                <div class="campo">
                    <div class="label">Nº de Sócios</div>
                    <div class="valor">{{ $cooperativa->numero_socios ?? 0 }}</div>
                </div>
                <div class="campo">
                    <div class="label">Principal Cultura</div>
                    <div class="valor">{{ $cooperativa->principal_cultura ?? '—' }}</div>
                </div>
            </div>
        </div>

        <!-- Localização -->
        <div class="secao">
            <div class="secao-titulo">Localização</div>
            <div class="grid">
                <div class="campo">
                    <div class="label">Província</div>
                    <div class="valor">{{ $cooperativa->provincia ?? '—' }}</div>
                </div>
                <div class="campo">
                    <div class="label">Município</div>
                    <div class="valor">{{ $cooperativa->municipio ?? '—' }}</div>
                </div>
                <div class="campo campo-full">
                    <div class="label">Endereço Completo</div>
                    <div class="valor">{{ $cooperativa->endereco ?? '—' }}</div>
                </div>
            </div>
        </div>

        <!-- Contactos -->
        <div class="secao">
            <div class="secao-titulo">Contactos</div>
            <div class="grid">
                <div class="campo">
                    <div class="label">Telefone</div>
                    <div class="valor">{{ $cooperativa->telefone ?? '—' }}</div>
                </div>
                <div class="campo">
                    <div class="label">E-mail</div>
                    <div class="valor">{{ $cooperativa->email ?? '—' }}</div>
                </div>
                @if($cooperativa->website)
                <div class="campo campo-full">
                    <div class="label">Website</div>
                    <div class="valor">{{ $cooperativa->website }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Dados Agrícolas -->
        @if($cooperativa->area_total_cultivada || $cooperativa->numero_talhoes || $cooperativa->producao_estimada)
        <div class="secao">
            <div class="secao-titulo">Dados Agrícolas</div>
            <div class="grid">
                @if($cooperativa->area_total_cultivada)
                <div class="campo">
                    <div class="label">Área Total (ha)</div>
                    <div class="valor">{{ number_format($cooperativa->area_total_cultivada, 2, ',', '.') }}</div>
                </div>
                @endif
                @if($cooperativa->numero_talhoes)
                <div class="campo">
                    <div class="label">Nº de Talhões</div>
                    <div class="valor">{{ $cooperativa->numero_talhoes }}</div>
                </div>
                @endif
                @if($cooperativa->producao_estimada)
                <div class="campo campo-full">
                    <div class="label">Produção Estimada (ton)</div>
                    <div class="valor">{{ number_format($cooperativa->producao_estimada, 2, ',', '.') }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Agricultores Associados -->
        @if(isset($cooperativa->agricultores) && $cooperativa->agricultores->count() > 0)
        <div class="secao">
            <div class="secao-titulo">Agricultores Associados</div>
            <table class="membros-tabela">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>BI</th>
                        <th>Contacto</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cooperativa->agricultores as $ag)
                    <tr>
                        <td>{{ $ag->nome_completo }}</td>
                        <td>{{ $ag->bilhete ?? '—' }}</td>
                        <td>{{ $ag->telefone_principal ?? $ag->telefone ?? '—' }}</td>
                        <td>{{ $ag->pivot->cargo ?? 'Membro' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Rodapé -->
        <div class="rodape">
            SIAG — Sistema Integrado de Apoio à Gestão Agrícola<br>
            Documento gerado automaticamente · Válido sem assinatura
        </div>
    </div>
</body>
</html>