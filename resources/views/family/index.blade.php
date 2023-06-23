@extends('template')
@section('content')
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4">
          <p>Filter</p>
          <div class="card">
              <article class="card-group-item">
                  <header class="card-header">
                      <h6 class="title">Brands </h6>
                  </header>
                  <div class="filter-content">
                      <div class="card-body">
                          <form>
                              <label class="form-check">
                                  <input class="form-check-input" name='filter' type="radio" value="all">
                                  <span class="form-check-label">
                                      All Children Budi 
                                  </span>
                              </label>
                              <label class="form-check">
                                  <input class="form-check-input" name='filter' type="radio" value="cucu">
                                  <span class="form-check-label">
                                    grandson of the Budi
                                  </span>
                              </label>
                              <label class="form-check">
                                  <input class="form-check-input" name='filter' type="radio" value="female">
                                  <span class="form-check-label">
                                      Cucu Perempuan Dari Budi
                                  </span>
                              </label>
                              <label class="form-check">
                                <input class="form-check-input" name='filter' type="radio" value="2">
                                <span class="form-check-label">
                                    Bibi Dari Farah
                                </span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input" name='filter' type="radio" value="sepupu">
                              <span class="form-check-label">
                                  Sepupuh Laki-laki Dari Hani
                              </span>
                          </label>
                          </form>

                      </div> <!-- card-body.// -->
                  </div>
              </article>
          </div>
        </div>
        <div class="col-sm-8">
            <div class="mb-5 p-2">
                <a href="{{route('family-create')}}" class="btn btn-sm btn-primary float-end">Create</a>
            </div>
            @if (\Session::has('message'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('message') !!}</li>
                </ul>
            </div>
            @endif
            <div id="tree">
            <div class="tree">
                <ul>
                    <li>
                        <?php
                  foreach ($result as $key => $value) {
                    // echo json_encode($value);
                    echo "<a href='".route('families-edit', $value['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$value['name']."</a>";
                    echo "<ul>";
                      foreach($value['children'] as $d){
                        echo "<li><a href='".route('families-edit', $d['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$d['name']."</a>";
                        echo "<ul>";
                        foreach ($d['children'] as $ch) {
                            echo "<li><a href ='".route('families-edit', $ch['id'])."' title='Action' data-bs-toggle='popover' data-bs-trigger='hover' data-bs-content='Click for edit data'>".$ch['name']."</a></li>";
                          }
                          echo "</ul>";
                        echo "</li>";
                      }
                    echo "</ul>";
                  }

                ?>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
  <script>
    $(document).on('change', 'input[type="radio"]', function (event) {

        var id = null;// this gives me null
        if ($(this).is(':checked')) {
          id = $(this).val()
        } else {
        }
        $.ajax({
        type:'get',
        url:'/family',
        data: {
            id: id,
        },
        cache:false,
        success:function(data) {
          if(id !== null && id !== 'all'){
            const groupBy = (keys) =>
            data.reduce((r, e) => {
                      const key = keys.map((k) => e[k]).join("|");
                      const obj = {};
  
                      for (let [k, v] of Object.entries(e)) {
                          if (!r[key]) r[key] = {
                              rows: []
                          };
  
                          if (keys.includes(k)) {
                              r[key][k] = v;
                          } else {
                              obj[k] = v;
                          }
                      }
  
                      r[key].rows.push(obj);
                      return r;
                  }, {});
              let result = groupBy(["parent", "name"]);
              let objdata = Object.values(result);
              let html = '';
              html += '<ul>';
                objdata.forEach(b => {
                  html += '<li>'+b.name+'</li>';
                });
              html += '</ul>';
              $('#tree').html(html);
          }else{
            $('#tree').html(data);
          }
        },
        
        error: function (msg) {
            console.log(msg);
        }
        });

    });
  </script>
@endpush
@endsection();