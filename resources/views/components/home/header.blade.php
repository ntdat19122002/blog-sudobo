<div class="header">
    <!-- Button trigger modal -->
   
        <button class="ava" type="button" data-bs-toggle="modal" data-bs-target="#avaModal">
        </button>
    
</div>
    <!-- Modal -->

    <div class="modal fade" id="avaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <div class="modal-dialog">
           
            <div class="modal-content" id="areaModal">
                <button class="ava" type="button" data-bs-toggle="modal" data-bs-target="#avaModal">
                </button>
                <form method="post" action="logout" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit infomation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputFirstName" class="col-sm-2 col-form-label">First name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFirstName" placeholder="Password" name="firstName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputLastName" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLastName" placeholder="Password" name="lastName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Log out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
