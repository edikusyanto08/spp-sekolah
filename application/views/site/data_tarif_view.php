
				<h1>Daftar Tarif Modul Keuangan </h1>
				<?php ME()->print_flash_message(); ?>	
			<div id="err-msg" class="error msg" style="display:none">tes</div>
			<div id="info-msg" class="information msg" style="display:none">tes</div>

			<div id="form-layer" style="display: none">
			<form id="myform" class="uniform" action="<?php echo (@$action_url);?>">
				<fieldset>
					<legend>Form Master Tarif</legend>
					<dl class="inline">
						<dt><label for="kategori">Kategori</label></dt>
						<dd>
							<select id="kategori" name="kategori" class="medium">
								<?php foreach ($list_rate_category as $r) : ?>
								<option><?php echo $r; ?></option>
								<?php endforeach; ?>
							</select>
						</dd>

						<dt><label for="nama">Nama Tagihan</label></dt>
						<dd><input id="nama" type="text" name="nama" class="medium" value="<?php echo (@$sess->nama);?>" /></dd>

						<dt><label for="jumlah">Jumlah</label></dt>
						<dd><input style="text-align:right;" id="jumlah" type="text" name="jumlah" value="<?php echo (@$sess->jumlah);?>" /></dd>

						<dt><label for="">Keterangan</label></dt>
						<dd> <textarea id="keterangan" name="keterangan" class="medium"><?php echo (@$sess->keterangan);?></textarea> </dd>

						<dt><label for="recurrence">Frekuensi Tagih</label></dt>
						<dd>
							<select id="recurrence" name="recurrence">
								<option value="sekali">Satu kali</option>
								<option value="tahun">Tiap tahun</option>
								<option value="semester">Tiap semester</option>
								<option value="bulan">Tiap bulan</option>
							</select>
						</dd>

						<dt><label for="due_date">Jatuh Tempo</label></dt>
						<dd>
							<input style="text-align:right;" id="due_date" type="text" name="due_date" value="1" class="small" /> hari<br/>
							<input type="checkbox" name="notification" value="1" /> kirim SMS jika terjadi tunggakan
						</dd>

						<dt><label for="installment">Angsuran</label></dt>
						<dd>
							<select name="installment" id="installment" class="medium">
								<option value="1">Langsung lunas</option>
								<option value="2">Diangsur 2x</option>
								<option value="3">Diangsur 3x</option>
								<option value="4">Diangsur 4x</option>
								<option value="5">Diangsur 5x</option>
								<option value="6">Diangsur 6x</option>
								<option value="7">Diangsur 7x</option>
								<option value="8">Diangsur 8x</option>
								<option value="9">Diangsur 9x</option>
								<option value="10">Diangsur 10x</option>
								<option value="11">Diangsur 11x</option>
								<option value="12">Diangsur 12x</option>
							</select>
						</dd>
					</dl>
					
				</fieldset>
				<div class="buttons" style="text-align:right;">
					<button type="button" class="button grey" id="save-button">Simpan</button>
					<button type="button" class="button white" id="cancel-button">Batal</button>
				</div>
			</form>
			</div>

			<div id="list-layer">
			<form name="frm-filter-cat" id="frm-filter-cat" method="post" action="<?php echo (@$action_url);?>">
					<div style="float:left">
				  <label> <strong>Tampilkan Kategori :</strong> </label>
				  <select name="mn_kategori" id="mn_kategori">
						<option value=''>Semua</option>
						<?php foreach ($list_category as $category) : ?>
						<option <?php echo (mr_selected_if(@$sess->category, $category->get_category()));?> value="<?php echo ($category->get_category());?>"><?php echo ($category->get_category());?></option>
						<?php endforeach; ?>
                  </select>
					</div>
					<div class="buttons" style="text-align:right;">
						<button type="button" class="button green" id="new-button">Tambah</button>
					</div>
		  </form>
				
			
			<br/>
			<table id="tabel" class="gtable">
				<thead>
				<tr>
				  <th><div align="left"><strong>Kategori</strong></div></th>
					<th><div align="left"><strong>Tagihan</strong></div></th>
					<th><div align="right"><strong>Jumlah (Rp)</strong></div></th>
					<th><div align="right"><strong>Dibayar</strong></div></th>
					<th><div align="right"><strong>Cicilan</strong></div></th>
					<th><div align="center"><strong>Pilihan</strong></div></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($list_tarif as $tarif) : ?>	
				<tr>
					<td><?php echo ($tarif->get_category());?></td>
					<td><?php echo ($tarif->get_name());?></td>
					<td style="text-align:right;"><?php echo ($tarif->get_fare(TRUE));?></td>
					<td style="text-align:right;"><?php echo ($tarif->get_recurrence(TRUE));?></td>
					<td style="text-align:right;"><?php echo ($tarif->get_installment());?>x</td>
					<td style="text-align:center;">
						<a title="Edit" href="<?php echo ME()->get_edit_link($tarif); ?>"><img alt="Edit" src="images/icons/edit.png"></a>
						<?php if (true) : ?>
						<a title="Delete" href="<?php echo ME()->get_delete_link($tarif); ?>" class="delete-row"><img alt="Delete" src="images/icons/cross.png"></a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>
		<div class="tablefooter clearfix">
						<div class="actions">
							Keterangan: <img alt="Edit" src="images/icons/edit.png"> Ubah data  <img alt="Delete" src="images/icons/cross.png"> Hapus data
						</div>
						<div class="pagination">
							<!--<a href="#">Prev</a>
							<a class="current" href="#">1</a>
							<a href="#">2</a>
							<a href="#">3</a>
							<a href="#">4</a>
							<a href="#">5</a>
							...
							<a href="#">78</a>
							<a href="#">Next</a>-->
						</div>
					</div>
		</div>
		</div><!--list-layer-->


			<script>
				document.getElementById('mn_kategori').onchange = function() {
					document.getElementById('frm-filter-cat').submit();
				}
				jQuery('#new-button').click(function() {
					jQuery('#form-layer').slideDown();
					jQuery('#list-layer').hide();
				});
				jQuery('#cancel-button').click(function() {
					jQuery('#form-layer').slideUp();
					jQuery('#list-layer').show();
				});
				jQuery('#save-button').click(function() {
					flashDialog('err-msg', 'Fitur ini masih dalam pengembangan', 5);
				});

			</script>
