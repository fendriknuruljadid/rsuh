<!-- modal small -->
			<div class="modal fade" id="japel" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Detail Nota</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body card-block">
                  <div class="table-responsive table table-striped">
                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                              <thead>
                                <th>Nama Jasa</th>
                                <th>Biaya</th>
                              </thead>
                            <tbody>
                            <?php foreach ($this->ModelBilling->japel($id)->result() as $value): ?>
                              <tr>
                                <td>
                                  <?php echo $value->jsmedis ?>
                                </td>
                                <td>
                                  <?php echo $value->harga ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                          </table>
                      </div>
                  </div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
								<button class="btn btn-danger btn-md pull-right" data-dismiss="modal">close</button>
						</div>
			</div>
		</div>
	</div>
			<!-- end modal small -->
