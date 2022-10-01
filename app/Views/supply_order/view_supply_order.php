<div class="container">
    <h3 class="mt-3">Supply Order Data</h3>
    <table class="table table-striped table-bordered" style="width:100%">
        <tbody>
            <?php
            for($i = 1; $i < sizeof($supply_order) - 1; $i+=2)
            {
            ?>
            <tr>
                <td class="font-weight-bold"><?= $labels[$i]['label'] ?></td>
                <td><?= $supply_order[$keys[$i]] ?></td>
                <?php if($i+1 < sizeof($supply_order) - 1){ ?>
                <td class="font-weight-bold"><?= $labels[$i+1]['label'] ?></td>
                <td><?= $supply_order[$keys[$i+1]] ?></td>
                <?php } ?>
            </tr>
            <?php   
                }
            ?>
        </tbody>
    </table>
</div>