<div class="container">
    <h3 class="mt-3">Site Installation</h3>
    <h4 class="mt-3">Site Installation Images</h4>
    <div>
        <?php if (isset($validation)): ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pv_module_pic">PV Modules Pic</label>
                        <div>
                            <?php if ($site_installation[0]['pv_module_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['pv_module_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['pv_module_pic']==""): ?>
                                <label for="pv_module_pic">Select a file:</label>
                                <input type="file" id="pv_module_pic" name="pv_module_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['pv_module_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['pv_module_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="storage_inverter_module_pic">Storage & Inverter Module Pic</label>
                        <div>
                            <?php if ($site_installation[0]['storage_inverter_module_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['storage_inverter_module_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['storage_inverter_module_pic']==""): ?>
                                <label for="storage_inverter_module_pic">Select a file:</label>
                                <input type="file" id="storage_inverter_module_pic" name="storage_inverter_module_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['storage_inverter_module_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['storage_inverter_module_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="earthing_pic">Earthing Pic</label>
                        <div>
                            <?php if ($site_installation[0]['earthing_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['earthing_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['earthing_pic']==""): ?>
                                <label for="earthing_pic">Select a file:</label>
                                <input type="file" id="earthing_pic" name="earthing_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['earthing_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['earthing_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lights_pic">Lights Pic</label>
                        <div>
                            <?php if ($site_installation[0]['lights_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['lights_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['lights_pic']==""): ?>
                                <label for="lights_pic">Select a file:</label>
                                <input type="file" id="lights_pic" name="lights_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['lights_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['lights_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fans_pic">Fans Pic</label>
                        <div>
                            <?php if ($site_installation[0]['fans_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['fans_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['fans_pic']==""): ?>
                                <label for="fans_pic">Select a file:</label>
                                <input type="file" id="fans_pic" name="fans_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['fans_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['fans_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="distribution_board_pic">Distribution Boards Pic</label>
                        <div>
                            <?php if ($site_installation[0]['distribution_board_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['distribution_board_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['distribution_board_pic']==""): ?>
                                <label for="distribution_board_pic">Select a file:</label>
                                <input type="file" id="distribution_board_pic" name="distribution_board_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['distribution_board_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['distribution_board_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dc_wiring_pic">DC Wiring Pic</label>
                        <div>
                            <?php if ($site_installation[0]['dc_wiring_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['dc_wiring_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['dc_wiring_pic']==""): ?>
                                <label for="dc_wiring_pic">Select a file:</label>
                                <input type="file" id="dc_wiring_pic" name="dc_wiring_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['dc_wiring_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['dc_wiring_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ac_wiring_pic">AC Wiring Pic</label>
                        <div>
                            <?php if ($site_installation[0]['ac_wiring_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['ac_wiring_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['ac_wiring_pic']==""): ?>
                                <label for="ac_wiring_pic">Select a file:</label>
                                <input type="file" id="ac_wiring_pic" name="ac_wiring_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['ac_wiring_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['ac_wiring_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_1">Optional Pic - 1</label>
                        <div>
                            <?php if ($site_installation[0]['optional_pic_1']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_1']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['optional_pic_1']==""): ?>
                                <label for="optional_pic_1">Select a file:</label>
                                <input type="file" id="optional_pic_1" name="optional_pic_1">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['optional_pic_1']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['optional_pic_1']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_2">Optional Pic - 2</label>
                        <div>
                            <?php if ($site_installation[0]['optional_pic_2']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_2']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['optional_pic_2']==""): ?>
                                <label for="optional_pic_2">Select a file:</label>
                                <input type="file" id="optional_pic_2" name="optional_pic_2">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['optional_pic_2']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['optional_pic_2']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_3">Optional Pic - 3</label>
                        <div>
                            <?php if ($site_installation[0]['optional_pic_3']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_3']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['optional_pic_3']==""): ?>
                                <label for="optional_pic_3">Select a file:</label>
                                <input type="file" id="optional_pic_3" name="optional_pic_3">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['optional_pic_3']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['optional_pic_3']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_4">Optional Pic - 4</label>
                        <div>
                            <?php if ($site_installation[0]['optional_pic_4']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_4']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['optional_pic_4']==""): ?>
                                <label for="optional_pic_4">Select a file:</label>
                                <input type="file" id="optional_pic_4" name="optional_pic_4">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['optional_pic_4']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['optional_pic_4']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_5">Optional Pic - 5</label>
                        <div>
                            <?php if ($site_installation[0]['optional_pic_5']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_5']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($site_installation[0]['optional_pic_5']==""): ?>
                                <label for="optional_pic_5">Select a file:</label>
                                <input type="file" id="optional_pic_5" name="optional_pic_5">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($site_installation[0]['optional_pic_5']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($site_installation[0]['optional_pic_5']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <hr>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/site_installations/site_installation_images/".$site_installation[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="site_installation_complete" id="site_installation_complete" value="1">
                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Complete Site Installation</button>
            </form>
        </div>
    </div>
</div>