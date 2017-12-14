<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
    
        <section class="content-header no-margin">
            <h1 class="text-center">
                Danh sách đăng ký nhận tin
            </h1>
        </section>

        <section class="content">
            <div class="mailbox row">
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="text-right" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name="fkeyword" placeholder="<?= tim_kiem?>">
                                            <div class="input-group-btn">
                                                <button type="submit" name="fsearchtour" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table   table-bordered">
                                            <tbody>
                                            <tr class="unread">
                                                <th>STT</th>
                                                <th class="text-left">Người gửi</th>
												<th class="text-left">Email</th>
												<th class="text-left">Điện thoại</th>
												<th class="text-left">Công việc</th>
                                                <th>Nội dung</th>
                                                <th>Thời gian gửi</th>
                                            </tr>
                                            <?php if($list){
                                                $i=1;
                                                foreach($list as $item){
                                                    /**begin trang thai*/
                                                    $open_strong = $item['mailto_read']==0?"<strong>":"";
                                                    $close_strong = $item['mailto_read']==0?"</strong>":"";
                                                    $unread = $item['mailto_read']==0?"unread":"";
                                                  $link_info = admin_url.'mailto/info/'.$item['id'].'/?redirect='.base64_encode(current_url());
                                                    ?>
                                                    <tr class="<?= $unread?>">
                                                        <td  > <?=$i;?>  </td>
                                                        <td class="name">
                                                            <a href="<?= $link_info?>" title="<?= (isset($item['mailto_email']) && $item['mailto_email'])?$item['mailto_email']:''?>">
                                                                <?= $open_strong?><?= (isset($item['mailto_fullname']) && $item['mailto_fullname'])?$item['mailto_fullname']:''?><?= $close_strong?>
                                                            </a>
                                                        </td>
														<td class="text-left"> <?=$item['mailto_email']?></td>
												<td class="text-left"><?=$item['mailto_phone']?> </td>
												<td class="text-left"> <?=$item['mailto_work']?>  </td>
                                                        <td class="subject">
                                                            <a href="<?= $link_info?>">
                                                                <?= $open_strong?><?= (isset($item['mailto_title']) && $item['mailto_title'])?$item['mailto_title']:''?><?= $close_strong?>
                                                                <small class="text-gray"><?= (isset($item['mailto_content']) && $item['mailto_content'])?'- '.substring(strip_tags($item['mailto_content']),100):''?></small>
                                                            </a>
                                                        </td>
                                                        <td class="time" title="<?= (isset($item['mailto_create_date']) && $item['mailto_create_date'])?date("d/m/Y h:i:s a",$item['mailto_create_date']):'';?>">
                                                            <?php
                                                            if( (isset($item['mailto_create_date']) && $item['mailto_create_date'])){
                                                                if(date("d")==date("d",$item["mailto_create_date"])){
                                                                    echo date("h:i a",$item['mailto_create_date']);
                                                                    echo ' <i class="fa fa-clock-o" style="cursor: help;"></i>';
                                                                }else{
                                                                    echo  $item['mailto_create_date'];
                                                                    echo ' <i class="fa fa-calendar" style="cursor: help;"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }?>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php if(isset($pagination)){echo $pagination;};?>
                                <li class="disabled"><a><?= tat_ca?>: <?= $record?> email</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </aside>
</form>
