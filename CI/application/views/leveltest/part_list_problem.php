<table class="table table-hover" border="0">
    <tbody>
    <tr bgcolor="#b0def8" onmouseover="this.style.background='#b0def8'" onmouseout="this.style.background='#b0def8'" >
        <th width="5%">No.</th>
        <th>질문</th>
    </tr>

<?php
$opt_question = "<option value='0'>== 선택 없음 ==</option>\n" ;
    $next_problem_num = 1 ;

    foreach ($list as $lt) {
    $link_problem = "/CI/Problem_set/problem_edit/" . $lt->n_auto ;
    $opt_question .= "<option value='". $lt->n_auto ."' style=\"background-color: #FFCC66;\">". $lt->num_v . ":" . $lt->question_str ."</option>\n" ;

        if( $lt->resultcnt < 2 )
        {
            $error_state_icon = "<span class='label label-danger'>ERROR</span>";
        }
        else if( $lt->sum_cnt < 2 )
        {
            $error_state_icon = "<span class='label label-danger'>ERROR</span>";
        }
        else
        {
            $error_state_icon = "";
        }

    ?>
    <tr>
        <td><?php echo $lt->num_v ; ?></td>
        <td> <?=$error_state_icon?> <a href="<?php echo $link_problem ; ?>"><?php echo $lt->question_str ; ?></a></td>
    </tr>
    <?php
        $next_problem_num = $lt->num_v + 1 ;
    }
    ?>

    </tbody>
</table>

<?php
$opt_result = "<option value='0'>== 선택 없음 ==</option>\n" ;

foreach ($result_list as $lt) {
$opt_result .= "<option value='". $lt->n_result ."' style=\"background-color: #FFCC66;\">". $lt->title_v ."</option>\n" ;
}
?>
