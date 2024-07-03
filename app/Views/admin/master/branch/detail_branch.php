<div class="container-fluid">
<div class="d-flex justify-content-between mb-3">
    <h3> Detail SBU</h3>
    <a href="/branch/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card shadow">
    <div class="card-body">
      <div class="table table-responsive">
            <table class="table table-bordered">
                  <tr>
                        <td>Branch Code</td>
                        <td><?= $branch['branch_code'] ?></td>
                  </tr>
                  <tr>
                        <td>Branch Name</td>
                        <td><?= $branch['branch_name'] ?></td>
                  </tr>
                  <tr>
                        <td>Phone</td>
                        <td><?= $branch['phone'] ?></td>
                  </tr>
                  <tr>
                        <td>Fax</td>
                        <td><?= $branch['fax'] ?></td>
                  </tr>
                  <tr>
                        <td>Email</td>
                        <td><?= $branch['email'] ?></td>
                  </tr>
                        <td>Status</td>
                        <td><?= $branch['status'] ?></td>
                  </tr>
                  </tr>
                        <td>Address</td>
                        <td><?= $branch['address'] ?></td>
                  </tr>
            </table>
      </div>
   
      </div>
    </div>
</div>

</div>