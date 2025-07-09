<?php
/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
?>

<div class="timestamps pull-left">
    <table>
        <tr>
            <td style="padding-right: 5px;"><span class="label bg-green">CREATE</span></td>
            <td style="padding-right: 10px;">{{optional($element->creator)->email}}

            </td>
            <td style="padding-right: 5px;"><span class="label bg-orange">UPDATE</span></td>
            <td style="padding-top: 0;">{{optional($element->updater)->email}}

            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-right: 20px;">{{formatDateTime($element->created_at)}}</td>
            <td colspan="2">{{formatDateTime($element->updated_at)}}</td>
        </tr>
    </table>
</div>
