
<!-- [시작] 목록 //-->
<table class="table table-hover">
    <tbody><tr bgcolor="#b0def8" onmouseover="this.style.background='#b0def8'" onmouseout="this.style.background='#b0def8'" >
        <th>결과 Title</th>
        <th>1.링크 <font color="blue">종류</font> & <font color="green">URL</font></th>
        <th>2.링크 <font color="blue">종류</font> & <font color="green">URL</font></th>
    </tr>

    <?php
    foreach ($list as $lt)
    {
        $link_problem = "/CI/Problem_set/problem_result_edit/" . $lt->n_result ;
    ?>
        <tr>
            <td><a href="<?php echo $link_problem ; ?>"><b><?php echo $lt->title_v ; ?></b></a></td>
            <td><font color="blue"><?php echo $lt->img_1 ; ?></font> &nbsp;<font color="green"><?php echo $lt->img_1_link ; ?></font></td>
            <td><font color="blue"><?php echo $lt->img_2 ; ?></font> &nbsp;<font color="green"><?php echo $lt->img_2_link ; ?></font></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
