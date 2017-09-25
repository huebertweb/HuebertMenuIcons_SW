{extends file="parent:frontend/advanced_menu/index.tpl"}


{function name="categories_top" level=0}

    {$columnIndex = 0}
    {$menuSizePercentage = 100 - (25 * $columnAmount * intval($hasTeaser))}
    {$columnCount = 4 - ($columnAmount * intval($hasTeaser))}

    <ul class="menu--list menu--level-{$level} columns--{$columnCount}"{if $level === 0} style="width: {$menuSizePercentage}%;"{/if}>
        {block name="frontend_plugins_advanced_menu_list"}
            {foreach $categories as $category}
                {if $category.hideTop}
                    {continue}
                {/if}

                {$categoryLink = $category.link}
                {if $category.external}
                    {$categoryLink = $category.external}
                {/if}

                <li class="menu--list-item item--level-{$level}"{if $level === 0} style="width: 100%"{/if}>
                    {block name="frontend_plugins_advanced_menu_list_item"}
                        {if $category.attribute.menu_icon_name}
                            <a href="{$categoryLink|escapeHtml}" class="menu--list-item-link" title="{$category.name|escape}"><img src="{media path="media/image/{$category.attribute.menu_icon_name}"}">{$category.name}</a>
                        {else}
                            <a href="{$categoryLink|escapeHtml}" class="menu--list-item-link" title="{$category.name|escape}"> {$category.name}</a>
                        {/if}
                        <h1>test</h1>

                        {if $category.sub}
                            {call name=categories_top categories=$category.sub level=$level+1}
                        {/if}
                    {/block}
                </li>
            {/foreach}
        {/block}
    </ul>
{/function}



{block name="frontend_plugins_advanced_menu_button_category"}{/block}
{block name="frontend_plugins_advanced_menu_button_close"}{/block}