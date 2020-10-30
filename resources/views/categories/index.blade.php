@extends('layouts.app', ['activePage' => 'category-management', 'titlePage' => __('Gerenciamento de Categorias')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('Categorias') }}</h4>
              <p class="card-category"> {{ __('Aqui você pode gerenciar suas categorias de produtos') }}</p>
            </div>
            <div class="card-body">
              @if (session('status'))
                <div class="row">
                  <div class="col-sm-12">
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                      <span>{{ session('status') }}</span>
                    </div>
                  </div>
                </div>
              @endif
              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Categoria') }}</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                        {{ __('Nome') }}
                    </th>
                    <th>
                      {{ __('Descrição') }}
                    </th>
                    <th class="text-right">
                      {{ __('Ações') }}
                    </th>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <td>
                          {{ $category->name }}
                        </td>
                        <td>
                          {{ $category->description }}
                        </td>
                        
                        <td class="td-actions text-right">


                          <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('category.edit', ['category' => $category->id]) }}" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                          </a>

                        <form name="form_delete_category" data-id="{{$category->id}}">
                            {{-- action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post" --}}
                              @csrf
                              @method('delete')
                                {{-- <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja deletar esta categoria?") }}') ? this.parentElement.submit() : ''"> --}}
                                  <button class="btn btn-danger btn-link" data-toggle="modal" data-target="#exampleModal">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                  </button>  
                                {{-- </button> --}}
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
  {{-- To Ajax Requests --}}
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
  <script>
      $('#send_delete').click(function(){
        console.log('teste');
      })
        
    $('form[name="form_delete_category"]').submit(function(event){
      event.preventDefault()
      let dataid = $(this).attr('data-id')
      let url = "http://127.0.0.1:8000/categorias/" + dataid;

      // {{ route('category.destroy', ['category' =>" +dataid+ "]) }}"
      $.ajax({
        url: url,
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          console.log(response);
        }
      })
    })
  </script>
@endsection