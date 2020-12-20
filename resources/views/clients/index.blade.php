@extends('layouts.app', ['activePage' => 'client-management', 'titlePage' => __('Gerenciamento de Clientes')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Clientes') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar seus clientes') }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    @if (session('create'))
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('create') }}</span>
                      </div>
                      @endif
                      @if (session('edit'))
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('edit') }}</span>
                      </div>
                      @endif
                      @if (session('delete'))
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('delete') }}</span>
                      </div>
                      @endif
                    </div>
                  </div>
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('client.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Cliente') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Nome') }}
                      </th>
                      <th>
                        {{ __('Data de Nascimento') }}
                      </th>
                      <th>
                        {{ __('Sexo') }}
                      </th>
                      <th>
                        {{ __('Telefone') }}
                      </th>
                      <th>
                        {{ __('Cidade') }}
                      </th>
                      <th>
                        {{ __('Bairro') }}
                      </th>
                      <th>
                        {{ __('Rua') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($clients as $client)
                        <tr>
                          <td>
                            {{ $client->name }}
                          </td>
                          <td>
                            {{ date('d/m/Y', strtotime($client->date_birth))}}
                          </td>
                          <td>
                            {{ $client->sex }}
                          </td>
                          <td>
                            {{ $client->phone }}
                          </td>
                          <td>
                            {{ $client->city }}
                          </td>
                          <td>
                            {{ $client->neighborhood }}
                          </td>
                          <td>
                            {{ $client->address . ' - ' . $client->number}}
                          </td>
                          <td class="td-actions text-right">
                            @if ($client->status == 'Aguardando')
                            <form action="{{ route('client.update', ['client' => $client->id]) }}" method="post">
                                @csrf
                                @method('put')
                              <button type="button" class="btn btn-success btn-link" data-original-title="" title="" onclick="confirm('{{ __("Este pedido foi entregue?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">done</i>
                                <div class="ripple-container"></div>
                              </button>
                           </form>                               
                            @endif

                            <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('client.edit', ['client' => $client->id]) }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>

                            <form action="{{ route('client.destroy', ['client' => $client->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja deletar este cliente?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection