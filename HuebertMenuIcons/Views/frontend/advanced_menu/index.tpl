{extends file="parent:frontend/advanced_menu/index.tpl"}


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

{block name="frontend_plugins_advanced_menu_button_category"}{/block}
{block name="frontend_plugins_advanced_menu_button_close"}{/block}