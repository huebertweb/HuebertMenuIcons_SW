{extends file="parent:frontend/detail/index.tpl"}

{block name="frontend_detail_index_buybox" append}
    <div class="alert alert-info alert-custom">
        <div class="alert-left"><strong><i class="fa fa-info"></i></strong></div>
        <div class="alert-right">
            Alert testi   <a href="{$categoryLink|escapeHtml}" class="menu--list-item-link" title="{$category.name|escape}"><img src="{media path="media/image/{$category.attribute.menu_icon_name}"}">{$category.name}</a>
        </div>
    </div>
{/block}

