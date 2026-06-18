{{-- @extends('layouts.app') Ou o seu layout base (ex: layouts.master) --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIAG – Agricultores</title>
</head>
<body>
   
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ficha do Agricultor: {{ $agricultor->nome_completo }}</h2>
        <a href="{{ route('agricultores.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar à Lista
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-4">
                @if($agricultor->foto)
                    <img src="{{ asset('storage/' . $agricultor->foto) }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; font-size: 4rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                @endif
                <h4>{{ $agricultor->nome_completo }}</h4>
                <p class="text-muted">BI: {{ $agricultor->bilhete }}</p>
                <span class="badge bg-{{ $agricultor->estado == 'activo' ? 'success' : 'danger' }} p-2">
                    {{ ucfirst($agricultor->estado) }}
                </span>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h5 class="border-bottom pb-2 text-success"><i class="bi bi-person-vcard"></i> Informações Pessoais</h5>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>NIF:</strong> {{ $agricultor->nif ?? 'N/A' }}</div>
                    <div class="col-md-6"><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($agricultor->data_nascimento)->format('d/m/Y') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>Telefone:</strong> {{ $agricultor->telefone_principal }}</div>
                    <div class="col-md-6"><strong>E-mail:</strong> {{ $agricultor->email ?? 'N/A' }}</div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12"><strong>Endereço:</strong> {{ $agricultor->endereco ?? 'Não informado' }}</div>
                </div>

                <h5 class="border-bottom pb-2 text-success"><i class="bi bi-building"></i> Vínculo Cooperativo</h5>
                <div class="row">
                    <div class="col-md-6"><strong>Cooperativa Atual:</strong> {{ $cooperativaNome }}</div>
                    <div class="col-md-6"><strong>Cargo / Função:</strong> {{ $cargoCooperativa }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
