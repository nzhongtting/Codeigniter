<table class="table table-hover" border="0">
    <tbody>
    <tr bgcolor="#b0def8" onmouseover="this.style.background='#b0def8'" onmouseout="this.style.background='#b0def8'" >
        <th width="5%">No.</th>
        <th>질문</th>
    </tr>

    <?php
    /*
      Tbl_problem
        n_auto
        group_v		문제 그룹
        num_v		보이는 번호
        question_str	질문

    Tbl_pro_result
        n_result
        group_v		문제 그룹
        title_v		초급, 입문, ~~~
        msg_v		설명 표현~~~ html code
        img_1
        img_1_link
        img_2
        img_2_link

    */

    $opt_question = "<option value='0'>== 선택 없음 ==</option>\n" ;

    $next_problem_num = 1 ;

    $n_auto = $this->uri->segment(3) ;      //  problem  key

    foreach ($list as $lt) {

        $link_problem = "/CI/Problem_set/problem_edit/" . $lt->n_auto ;

        if ($n_auto != $lt->n_auto) {
            $opt_question .= "<option value='". $lt->n_auto ."' style=\"background-color: #FFCC66;\">". $lt->num_v . ":" . $lt->question_str ."</option>\n" ;
        }

        ?>
        <tr>
            <td><?php echo $lt->num_v ; ?></td>
            <td><a href="<?php echo $link_problem ; ?>"><?php echo $lt->question_str ; ?></a></td>
        </tr>
        <?php

        $next_problem_num = $lt->num_v + 1 ;
    }

    $opt_result = "<option value='0'>== 선택 없음 ==</option>\n" ;

    foreach ($result_list as $lt) {
        $opt_result .= "<option value='". $lt->n_result ."' style=\"background-color: #FFCC66;\">". $lt->title_v ."</option>\n" ;
    }
    ?>
    </tbody>
</table>
