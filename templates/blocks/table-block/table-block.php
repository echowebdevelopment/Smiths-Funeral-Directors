<?php
/**********************************************************
 *
 * File:         Table Block (Repeater-Based)
 * Description:  ACF block that renders a table using nested repeaters
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     18/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$section_title       = get_field( 'section_title' );
$section_description = get_field( 'section_description' );
$table_rows          = get_field( 'table_rows' );
?>

<?php if ( $table_rows ) : ?>
<section class="table-block echo-block <?php echo esc_attr($block['className'] ?? ''); ?>">
    <div class="container">
        <?php if ( $section_title ) : ?>
            <h2 class="text-center mb-3"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <?php if ( $section_description ) : ?>
            <div class="text-center text-muted mb-4">
                <?php echo wp_kses_post( $section_description ); ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table align-middle">
                <tbody>
                    <?php $row_count = 0; ?>
                    <?php foreach ( $table_rows as $row ) :
                        $row_cells = $row['row_cells'];
                        $row_count++;
                    ?>
                        <tr>
                            <?php foreach ( $row_cells as $cell ) : ?>
                                <?php if ( $row_count === 1 ) : ?>
                                    <th><?php echo wp_kses_post( $cell['cell_content'] ); ?></th>
                                <?php else : ?>
                                    <td><?php echo wp_kses_post( $cell['cell_content'] ); ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>
