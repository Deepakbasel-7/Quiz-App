<?php
include_once('conn.php');

if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    $sqlQuestions = "SELECT * FROM questions WHERE categories = '$selectedCategory'";
    $resQuestions = mysqli_query($conn, $sqlQuestions);

    if (mysqli_num_rows($resQuestions) > 0) {
        while ($rowQuestion = mysqli_fetch_assoc($resQuestions)) {
            ?>
            <h3><?php echo $rowQuestion['question']; ?></h3>
            <ul>
                <?php
                $separates = explode(',', $rowQuestion['options']);
                $i = 1;

                foreach ($separates as $separate) {
                    ?>
                    <li>
                        <input type="radio" name="options[<?php echo $rowQuestion['qid']; ?>]" value="<?php echo $i; ?>">
                        <?php echo $separate; ?>
                    </li>
                    <?php
                    $i++;
                }
                ?>
            </ul>
            <?php
        }
    } else {
        echo "No questions available for the selected category.";
    }
}
?>
