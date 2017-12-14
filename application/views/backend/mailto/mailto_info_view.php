<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
    
        <section class="content-header no-margin">
            <h1 class="text-center">
               Chi tiết
            </h1>
        </section>

        <section class="content">
            <div class="mailbox row">
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-strip" style="font-size:15px;">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?= (isset($info['mailto_title']) && $info['mailto_title'])?$info['mailto_title']:''?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Họ tên</td>
                                            <td><?= (isset($info['mailto_fullname']) && $info['mailto_fullname'])?$info['mailto_fullname']:''?></td>
                                        </tr>
                                       <!-- <tr>
                                            <td>Địa chỉ</td>
                                            <td><?//= (isset($info['mailto_address']) && $info['mailto_address'])?$info['mailto_address']:''?></td>
											<td></td>
									   </tr> -->
                                        <tr>
                                            <td>Phone</td>
                                            <td><?= (isset($info['mailto_phone']) && $info['mailto_phone'])?$info['mailto_phone']:''?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= (isset($info['mailto_email']) && $info['mailto_email'])?$info['mailto_email']:''?></td>
                                        </tr>
                                        <!--<tr>
                                            <td>Tiêu đề</td>
                                            <td>
                                                <?= (isset($info['mailto_title']) && $info['mailto_title'])?$info['mailto_title']:''?>
                                            </td>
                                        </tr>-->
										 <tr>
                                            <td>Nghề nghiệp</td>
                                            <td><?= (isset($info['mailto_work']) && $info['mailto_work'])?$info['mailto_work']:''?></td>
                                        </tr>
                                        <tr>
                                            <td>Nội dung</td>
                                            <td>
                                                <?= (isset($info['mailto_content']) && $info['mailto_content'])?$info['mailto_content']:''?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ngày gửi</td>
                                            <td><?= (isset($info['mailto_create_date']) && $info['mailto_create_date'])?date("d/m/Y h:m a",$info['mailto_create_date']):''?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </aside>
</form>