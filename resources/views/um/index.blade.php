@extends('layouts.app', ['activePage' => 'um-management', 'titlePage' => __('Gerenciamento de Unidades de Medida')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('Unidades de Medida') }}</h4>
              <p class="card-category"> {{ __('Aqui você pode gerenciar as unidades de medida dos seus produtos') }}</p>
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
                  <a href="{{ route('um.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Unidade de Medida') }}</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                        {{ __('Sigla') }}
                    </th>
                    <th>
                      {{ __('Descrição') }}
                    </th>
                  </thead>
                  <tbody>
                    @foreach($um as $um)
                      <tr>
                        <td>
                          {{ $um->initials }}
                        </td>
                        <td>
                          {{ $um->description }}
                        </td>
                        
                        <td class="td-actions text-right">
                          <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('um.edit', ['um' => $um->id]) }}" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                          </a>

                          <form action="{{ route('um.destroy', ['um' => $um->id]) }}" method="post">
                              @csrf
                              @method('delete')
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja deletar este produto?") }}') ? this.parentElement.submit() : ''">
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