<!-- Modal -->
<div class="modal fade" id="createGradeModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >{{__('grades.index.create_grade')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          <form action="{{route('grade.store')}}" method="post" >
            
            <div class="modal-body">
            @include('grades._form')
            @csrf
            </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{__('grades.index.submit')}}</button>
          </div>
          
        </form>

      </div>
    </div>
  </div>
