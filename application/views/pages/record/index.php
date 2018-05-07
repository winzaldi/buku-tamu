<div class="row">

</div>
<div class="row">
    <div class="col-sm-12">

        <div class="float-left">
            <div class="text-center">
                <div class="mt-3">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <button id="btnTambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="float-right pb-3">
            <div class="card text-center">
                <div class="card-header">
                    <form action="index.php" method="get" id="form-tamu">
                        <input type="hidden" name="page" value="<?= $this->paging->getPage(); ?>">

                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="mr-sm-2" for="sort">Sort by</label>
                            </div>
                            <div class="col-auto">

                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sort" name="sort">
                                    <option value="date" <?= ($_SESSION['sort'] == 'date' ? 'selected' : ''); ?>>Date
                                    </option>
                                    <option value="name" <?= ($_SESSION['sort'] == 'name' ? 'selected' : ''); ?>>Nama
                                    </option>
                                    <option value="address" <?= ($_SESSION['sort'] == 'address' ? 'selected' : ''); ?>>
                                        Alamat
                                    </option>
                                    <option value="instansi" <?= ($_SESSION['sort'] == 'instansi' ? 'selected' : ''); ?>>
                                        Instansi
                                    </option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="order" name="order">
                                    <option value="asc" <?= ($_SESSION['order'] == 'asc' ? 'selected' : ''); ?>>
                                        Ascending
                                    </option>
                                    <option value="desc" <?= ($_SESSION['order'] == 'desc' ? 'selected' : ''); ?>>
                                        Descending
                                    </option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Sort</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Instansi</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Kesan</th>
                <th scope="col">Pesan</th>

                <? if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && Db::getUserRole($_SESSION['email']) == 'admin') : ?>
                    <th scope="col">IP</th>
                    <th scope="col">Manage</th>
                <? endif; ?>
            </tr>
            </thead>
            <tbody>
            <?
            $nomor = $_GET['page'];
            if(!isset($nomor)){
                $nomor = 1;
            }else{
                if($nomor > 1){
                 $nomor = (($nomor * __ITEMS_PER_PAGE__) - __ITEMS_PER_PAGE__ )+ 1;
                }
            }

            foreach ($this->model as $record): ?>
                <? if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && Db::getUserRole($_SESSION['email']) == 'admin') : ?>
                    <tr id="record<?= $record->getId(); ?>">
                <? else: ?>
                    <tr>
                <? endif; ?>
                <td><?= $nomor; ?></td>
                <td><?= $record->getDate(); ?></td>
                <? if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && Db::getUserRole($_SESSION['email']) == 'admin') : ?>
                    <td class="editable" data-column="name" data-id="<?= $record->getId(); ?>"><?= $record->getName(); ?></td>
                    <td class="editable" data-column="address" data-id="<?= $record->getId(); ?>"><?= $record->getAddress(); ?></td>
                    <td class="editable" data-column="instansi" data-id="<?= $record->getId(); ?>"><?= $record->getInstansi(); ?></td>
                    <td class="editable" data-column="jabatan" data-id="<?= $record->getId(); ?>"><?= $record->getJabatan(); ?></td>
                    <td class="editable" data-column="kesan" data-id="<?= $record->getId(); ?>"><?= $record->getKesan(); ?></td>
                    <td class="editable" data-column="pesan" data-id="<?= $record->getId(); ?>"><?= $record->getPesan(); ?></td>
                <? else: ?>
                    <td><?= htmlspecialchars($record->getName()); ?></td>
                    <td><?= htmlspecialchars($record->getAddress()); ?></td>
                    <td><?= htmlspecialchars($record->getInstansi()); ?></td>
                    <td><?= htmlspecialchars($record->getJabatan()); ?></td>
                    <td><?= htmlspecialchars($record->getKesan()); ?></td>
                    <td><?= htmlspecialchars($record->getPesan()); ?></td>
                <? endif; ?>
                <? if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && Db::getUserRole($_SESSION['email']) == 'admin') : ?>
                    <td><?= $record->getIp(); ?></td>
                    <td class="text-center"><a class="remove cursor-pointer" data-id="<?= $record->getId(); ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>
                <? endif; ?>
                </tr>
            <?
                $nomor++;
            endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal"  id="guestModal"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buku Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="card bg-light mb-3">
                        <div class="card-header">Selamat Datang di Stand Dinas Kominfo Kota Solok</div>
                        <div class="card-body">
                            <form action="index.php?action=save" id="submit_record" method="POST">

                                <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama"
                                               value="<?= htmlspecialchars($_POST['name']); ?>" >
                                </div>

                                <div class="form-group">
                                        <textarea rows="2" class="form-control" name="address" id="address" placeholder="Alamat"
                                                  ><?= htmlspecialchars($_POST['address']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Instansi"
                                           value="<?= htmlspecialchars($_POST['instansi']); ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan"
                                           value="<?= htmlspecialchars($_POST['jabatan']); ?>">
                                </div>

                                <div class="form-group">
                        <textarea rows="2" class="form-control" name="kesan"  id="kesan"placeholder="Kesan"
                                  ><?= htmlspecialchars($_POST['kesan']); ?></textarea>
                                </div>

                                <div class="form-group">
                        <textarea rows="2" class="form-control" name="pesan" id="pesan"  placeholder="pesan"
                                  ><?= htmlspecialchars($_POST['pesan']); ?></textarea>
                                </div>
                                <!--                    <div class="form-row">-->
                                <!--                        <div class="form-group col-md-3">-->
                                <!--                            --><?// $_SESSION['captcha'] = simple_php_captcha(); ?>
                                <!--                            <img class="form-control" src="--><?//= $_SESSION['captcha']['image_src'] ?><!--">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-3">-->
                                <!--                            <input type="text" class="form-control" name="captcha" placeholder="Captcha" required>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">For Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <? if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                                <h4 class="card-title">Welcome, <?= Db::getUserName($_SESSION['email']) ?>!</h4>
                                <? if (Db::getUserRole($_SESSION['email']) == 'admin') : ?>
                                    <p>Tip: You can edit some fields in the table. Just press on table cell.</p>
                                <? endif; ?>
                                <form action="index.php?action=logout" method="post">
                                    <button type="submit" class="btn btn-primary">Log Out</button>
                                </form>
                            <? else: ?>
                                <form action="index.php?action=login" method="post" id="login">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                               required>
                                        <small id="emailHelp" class="form-text text-muted">Email = admin@example.com<br>Email = user@example.com</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                               required>
                                        <small id="emailHelp" class="form-text text-muted">Password = password</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Log In</button>
                                </form>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
