<div class="container-fluid">
  <div class="container">
    <div class="d-flex justify-content-between mb-3">
      <h3>Detail Keluarga</h3>
      <?php if(session()->get('user_level') == 'admin') : ?>
      <a href="/family/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
      <?php elseif(session()->get('user_level') == 'user') : ?>
        <a href="/karyawan/detail_karyawan_pribadi/<?= $family['employee_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
      <?php endif; ?>
    </div>

    <div class="card">
      <div class="card-shadow">
        <div class="card-body">
          <div class="table table-responsive">
            <table class="table table-bordered">
              <tr>
                <td>Hubungan keluarga</td>
                <td>
                  <?php if($family['family_type'] == 1) : ?>
                    <span class="text-success">Ayah</span>
                  <?php elseif($family['family_type'] == 2) : ?>
                    <span class="text-success">Ibu</span>
                  <?php elseif($family['family_type'] == 3) : ?>
                    <span class="text-success">Saudara</span>
                  <?php elseif($family['family_type'] == 4) : ?>
                    <span class="text-success">Anak</span>
                  <?php elseif($family['family_type'] == 5) : ?>
                    <span class="text-success">Suami</span>
                  <?php elseif($family['family_type'] == 6) : ?>
                    <span class="text-success">Istri</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td>Nama Keluarga</td>
                <td><?= ($family['family_name']) ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>
                  <?php if($family['jenis_kelamin'] == 'L') : ?>
                    <span>Laki - laki</span>
                    <?php elseif($family['jenis_kelamin'] == 'P') : ?>
                      <span>Perempuan</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td>Tempat Lahir</td>
                <td><?= $family['lahir_tempat'] ?></td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td>
                <?= ($family['pekerjaan'] == '1') ? 'Pegawai Negeri' : '' ?>
                <?= ($family['pekerjaan'] == '2') ? 'Pegawai Swasta' : '' ?>
                <?= ($family['pekerjaan'] == '3') ? 'Ibu Rumah Tangga' : '' ?>
                <?= ($family['pekerjaan'] == '4') ? 'Wiraswasta' : '' ?>
                </td>
              </tr>
              <tr>
                <td>Nomor Hanphone 1</td>
                <td><?= $family['no_tlp'] ?></td>
              </tr>
              <tr>
                <td>Nomor Hanphone 2</td>
                <td><?= $family['no_tlp2'] ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>