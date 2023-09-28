<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_shortcode('cpt_generator_shortcode', 'cpt_generator');
function cpt_generator() {
	$nav_list = array(
		'tab0' => array(
			'tab' => '#tab_info',
			'icon' => 'fa-solid fa-circle-info',
			'label' => 'Connect',
		),
		'tab1' => array(
			'tab' => '#tab_general',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'General',
		),
		'tab2' => array(
			'tab' => '#tab_post_type',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'Post Type',
		),
		'tab3' => array(
			'tab' => '#tab_labels',
			'icon' => 'fa-solid fa-tags',
			'label' => 'Labels',
		),
		'tab4' => array(
			'tab' => '#tab_options',
			'icon' => 'fa-solid fa-gears',
			'label' => 'Options',
		),
		'tab5' => array(
			'tab' => '#tab_visibility',
			'icon' => 'fa-solid fa-eye',
			'label' => 'Visibility',
		),
		'tab6' => array(
			'tab' => '#tab_query',
			'icon' => 'fa-solid fa-file-code',
			'label' => 'Query',
		),
		'tab7' => array(
			'tab' => '#tab_permalinks',
			'icon' => 'fa-solid fa-link',
			'label' => 'Permalinks',
		),
		'tab8' => array(
			'tab' => '#tab_capabilities',
			'icon' => 'fa-solid fa-toolbox',
			'label' => 'Capabilities',
		),
		'tab9' => array(
			'tab' => '#tab_rest_api',
			'icon' => 'fa-solid fa-square-poll-horizontal',
			'label' => 'Rest API',
		),
	);
	?>
	<div class="wp-generator">
		<form name="generator_form" id="generator_form" action="" method="post">
		    <div class="wp-generator-tabs">
		        <ul class="nav nav-tabs fancyTabs" role="tablist">
		        	<?php $i = 1; ?>
		        	<?php foreach ($nav_list as $id => $list): ?>
			            <li class="tab fancyTab <?= $i==1?'active':'' ?>">
			            	<div class="arrow-down"><div class="arrow-down-inner"></div></div>
			                <a id="<?= $id ?>" href="<?= $list['tab'] ?>" role="tab" data-toggle="tab">
			                	<span class="<?= $list['icon'] ?>"></span>
			                	<span class="hidden-xs"><?= $list['label'] ?></span>
			                </a>
			                <div class="whiteBlock"></div>
			            </li>
			            <?php $i++; ?>
			        <?php endforeach; ?>
		        </ul>
		        <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
		            <div class="tab-pane  fade active in" id="tab_info" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
	                    <div class="field-group-info">
	                        <div class="field-group-col">
	                            <p><strong>Overview</strong></p>
	                            <p>
	                                Use this tool to create custom code for <a href="https://wordpress.org/support/article/post-types/" target="_blank">Post Types</a> with
	                                <a href="https://developer.wordpress.org/reference/functions/register_post_type/" target="_blank">register_post_type()</a> function.
	                            </p>
	                        </div>
	                        <div class="field-group-col">
	                            <p><strong>Usage</strong></p>
	                            <ul>
	                                <li>Fill in the user-friendly form.</li>
	                                <li>Click the “Update Code” button.</li>
	                                <li>Copy the code to your project.</li>
	                            </ul>
	                        </div>
	                        <div class="field-group-col">
	                            <p><strong>Examples</strong></p>
	                            <p>If you are still learning how to use this tool, check out the following examples:</p>
	                            <ul>
	                                <li><a href="?cpt=testimonials">Testimonials</a></li>
	                                <li><a href="?cpt=property">Property</a></li>
	                                <li><a href="?cpt=team">Team members</a></li>
	                            </ul>
	                        </div>
	                    </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_general" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info" style="justify-content: ">
			                <div class="field-group-col">
			                    <div class="form-group function_name">
			                        <label title="Function Name.">Function Name</label>
			                        <input type="text" class="form-control" name="function_name" value="custom_post_type" />
			                        <span class="help-block">The function used in the code.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group text_domain">
			                        <label title="Text Domain.">Text Domain</label>
			                        <input type="text" class="form-control" name="text_domain" value="text_domain" />
			                        <span class="help-block">Translation file <a href="https://developer.wordpress.org/reference/functions/load_textdomain/" target="_blank">Text Domain</a>. Optional.</span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_post_type" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group post_type">
			                        <label title="Post Type Key.">Post Type Key</label>
			                        <input type="text" class="form-control" name="post_type" value="post_type" maxlength="20" />
			                        <span class="help-block">Key used in the code. Up to 20 characters, lowercase, no spaces.</span>
			                    </div>
			                    <div class="form-group description">
			                        <label title="Description.">Description</label>
			                        <input type="text" class="form-control" name="description" value="Post Type Description" />
			                        <span class="help-block">A short descriptive summary of what the post type is.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group singular_name">
			                        <label title="Name (Singular).">Name (Singular)</label>
			                        <input type="text" class="form-control" name="singular_name" value="Post Type" />
			                        <span class="help-block">Post type singular name. e.g. Product, Event or Movie.</span>
			                    </div>
			                    <div class="form-group plural_name">
			                        <label title="Name (Plural).">Name (Plural)</label>
			                        <input type="text" class="form-control" name="plural_name" value="Post Types" />
			                        <span class="help-block">Post type plural name. e.g. Products, Events or Movies.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group taxonomies">
			                        <label title="Link To Taxonomies.">Link To Taxonomies</label>
			                        <input type="text" class="form-control" name="taxonomies" value="category,post_tag" />
			                        <span class="help-block">Comma separated list of <a href="https://codex.wordpress.org/Taxonomies" target="_blank">Taxonomies</a>.</span>
			                    </div>
			                    <div class="form-group hierarchical">
			                        <label title="Hierarchical.">Hierarchical</label>
			                        <select class="form-control" name="hierarchical" id="hierarchical">
			                            <option value="true">Yes (like pages)</option>
			                            <option selected="" value="false">No (like posts)</option>
			                        </select>
			                        <span class="help-block">Hierarchical post types allows descendants.</span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_labels" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
						    <div class="col-3">
						        <div class="form-group add_new">
						            <label title="Add New.">Add New</label>
						            <input type="text" class="form-control" name="add_new" value="Add New" />
						        </div>
						        <div class="form-group add_new_item">
						            <label title="Add New Item.">Add New Item</label>
						            <input type="text" class="form-control" name="add_new_item" value="Add New Item" />
						        </div>
						        <div class="form-group edit_item">
						            <label title="Edit Item.">Edit Item</label>
						            <input type="text" class="form-control" name="edit_item" value="Edit Item" />
						        </div>
						        <div class="form-group new_item">
						            <label title="New Item.">New Item</label>
						            <input type="text" class="form-control" name="new_item" value="New Item" />
						        </div>
						        <div class="form-group view_item">
						            <label title="View Item.">View Item</label>
						            <input type="text" class="form-control" name="view_item" value="View Item" />
						        </div>
						        <div class="form-group view_items">
						            <label title="View Items.">View Items</label>
						            <input type="text" class="form-control" name="view_items" value="View Items" />
						        </div>
						        <div class="form-group not_found">
						            <label title="Not Found.">Not Found</label>
						            <input type="text" class="form-control" name="not_found" value="Not found" />
						        </div>
						        <div class="form-group not_found_in_trash">
						            <label title="Not Found in Trash.">Not Found in Trash</label>
						            <input type="text" class="form-control" name="not_found_in_trash" value="Not found in Trash" />
						        </div>
						        <div class="form-group parent_item_colon">
						            <label title="Parent Item.">Parent Item</label>
						            <input type="text" class="form-control" name="parent_item_colon" value="Parent Item:" />
						        </div>
						    </div>
						    <div class="col-3">
						        <div class="form-group all_items">
						            <label title="All Items.">All Items</label>
						            <input type="text" class="form-control" name="all_items" value="All Items" />
						        </div>
						        <div class="form-group archives">
						            <label title="Archives.">Archives</label>
						            <input type="text" class="form-control" name="archives" value="Item Archives" />
						        </div>
						        <div class="form-group attributes">
						            <label title="Attributes.">Attributes</label>
						            <input type="text" class="form-control" name="attributes" value="Item Attributes" />
						        </div>
						        <div class="form-group insert_into_item">
						            <label title="Insert into item.">Insert into item</label>
						            <input type="text" class="form-control" name="insert_into_item" value="Insert into item" />
						        </div>
						        <div class="form-group uploaded_to_this_item">
						            <label title="Uploaded to this item.">Uploaded to this item</label>
						            <input type="text" class="form-control" name="uploaded_to_this_item" value="Uploaded to this item" />
						        </div>
						        <div class="form-group featured_image">
						            <label title="Featured Image.">Featured Image</label>
						            <input type="text" class="form-control" name="featured_image" value="Featured Image" />
						        </div>
						        <div class="form-group set_featured_image">
						            <label title="Set featured image.">Set featured image</label>
						            <input type="text" class="form-control" name="set_featured_image" value="Set featured image" />
						        </div>
						        <div class="form-group remove_featured_image">
						            <label title="Remove featured image.">Remove featured image</label>
						            <input type="text" class="form-control" name="remove_featured_image" value="Remove featured image" />
						        </div>
						        <div class="form-group use_featured_image">
						            <label title="Use as featured image.">Use as featured image</label>
						            <input type="text" class="form-control" name="use_featured_image" value="Use as featured image" />
						        </div>
						    </div>
						    <div class="col-3">
						        <div class="form-group menu_name">
						            <label title="Menu Name.">Menu Name</label>
						            <input type="text" class="form-control" name="menu_name" value="Post Types" />
						        </div>
						        <div class="form-group filter_items_list">
						            <label title="Filter items list.">Filter items list</label>
						            <input type="text" class="form-control" name="filter_items_list" value="Filter items list" />
						        </div>
						        <div class="form-group filter_by_date">
						            <label title="Filter by date.">Filter by date</label>
						            <input type="text" class="form-control" name="filter_by_date" value="Filter by date" />
						        </div>
						        <div class="form-group items_list_navigation">
						            <label title="Items list navigation.">Items list navigation</label>
						            <input type="text" class="form-control" name="items_list_navigation" value="Items list navigation" />
						        </div>
						        <div class="form-group items_list">
						            <label title="Items list.">Items list</label>
						            <input type="text" class="form-control" name="items_list" value="Items list" />
						        </div>

						        <div class="form-group item_published">
						            <label title="Items published.">Items published</label>
						            <input type="text" class="form-control" name="item_published" value="Items published" />
						        </div>
						        <div class="form-group item_published_privately">
						            <label title="Items published privately.">Items published privately</label>
						            <input type="text" class="form-control" name="item_published_privately" value="Items published privately" />
						        </div>
						        <div class="form-group item_reverted_to_draft">
						            <label title="Items reverted to draft.">Items reverted to draft</label>
						            <input type="text" class="form-control" name="item_reverted_to_draft" value="Items reverted to draft" />
						        </div>
						        <div class="form-group item_scheduled">
						            <label title="Items scheduled.">Items scheduled</label>
						            <input type="text" class="form-control" name="item_scheduled" value="Items scheduled" />
						        </div>
						    </div>
						    <div class="col-3">
						        <div class="form-group item_updated">
						            <label title="Item updated.">Item updated</label>
						            <input type="text" class="form-control" name="item_updated" value="Item updated" />
						        </div>
						        <div class="form-group item_link">
						            <label title="Item link.">Item link</label>
						            <input type="text" class="form-control" name="item_link" value="Item link" />
						        </div>
						        <div class="form-group item_link_description">
						            <label title="Item link description.">Item link description</label>
						            <input type="text" class="form-control" name="item_link_description" value="Item link description" />
						        </div>
						        <div class="form-group name_admin_bar">
						            <label title="Admin Bar Name.">Admin Bar Name</label>
						            <input type="text" class="form-control" name="name_admin_bar" value="Post Type" />
						        </div>
						        <div class="form-group update_item">
						            <label title="Update Item.">Update Item</label>
						            <input type="text" class="form-control" name="update_item" value="Update Item" />
						        </div>
						        <div class="form-group search_items">
						            <label title="Search Item.">Search Item</label>
						            <input type="text" class="form-control" name="search_items" value="Search Item" />
						        </div>
						    </div>
						</div>
		            </div>
		            <div class="tab-pane  fade" id="tab_options" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group supports">
			                        <label title="Supports.">Supports</label>
			                        <div class="row">
			                            <div class="col-6">
			                                <label class="checkbox"><input checked="" type="checkbox" name="supports_title" value="true" /> Title</label>
			                                <label class="checkbox"><input checked="" type="checkbox" name="supports_editor" value="true" /> Content (editor)</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_comments" value="true" /> Comments</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_revisions" value="true" /> Revisions</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_trackbacks" value="true" /> Trackbacks</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_author" value="true" /> Author</label>
			                            </div>
			                            <div class="col-6">
			                            	<label class="checkbox"><input type="checkbox" name="supports_excerpt" value="true" /> Excerpt</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_page_attributes" value="true" /> Page Attributes</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_thumbnail" value="true" /> Featured Image</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_custom_fields" value="true" /> Custom Fields</label>
			                                <label class="checkbox"><input type="checkbox" name="supports_post_formats" value="true" /> Post Formats</label>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group exclude_from_search">
			                        <label title="Exclude From Search.">Exclude From Search</label>
			                        <select class="form-control" name="exclude_from_search" id="exclude_from_search">
			                            <option value="true">Yes</option>
			                            <option selected="" value="false">No</option>
			                        </select>
			                        <span class="help-block">Posts of this type should be excluded from search results.</span>
			                    </div>
			                    <div class="form-group can_export">
			                        <label title="Enable Export.">Enable Export</label>
			                        <select class="form-control" name="can_export" id="can_export">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Enables post type export.</span>
			                    </div>
			                    <div class="form-group delete_with_user">
			                        <label title="Enable Export.">Delete with user</label>
			                        <select class="form-control" name="delete_with_user" id="delete_with_user">
			                            <option selected="" value="">Default</option>
			                            <option value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Whether to delete posts of this type when deleting a user.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group has_archive">
			                        <label title="Enable Archives.">Enable Archives</label>
			                        <select class="form-control" name="has_archive" id="has_archive">
			                            <option value="false">No (prevent archive pages)</option>
			                            <option selected="" value="true">Yes (use default slug)</option>
			                            <option value="custom">Yes (set custom archive slug)</option>
			                        </select>
			                        <span class="help-block">Enables post type archives. Post type key is used as defauly archive slug.</span>
			                    </div>
			                    <div class="form-group custom_archive_slug">
			                        <label title="Custom Archive Slug.">Custom Archive Slug</label>
			                        <input type="text" class="form-control" name="custom_archive_slug" value="" disabled="disabled" />
			                        <span class="help-block">Set custom archive slug.</span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_visibility" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group public">
			                        <label title="Public.">Public</label>
			                        <select class="form-control" name="public" id="public">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in the admin UI.</span>
			                    </div>
			                    <div class="form-group show_ui">
			                        <label title="Show UI.">Show UI</label>
			                        <select class="form-control" name="show_ui" id="show_ui">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type UI in the admin.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group show_in_admin_sidebar">
			                        <label title="Show in Admin Sidebar.">Show in Admin Sidebar</label>
			                        <select class="form-control" name="show_in_menu" id="show_in_menu" style="width: 20%;">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <select class="form-control" name="menu_position" id="menu_position" style="width: 78%;" data-select2-current-value="5">
			                            <option selected="" value="5">5 - below Posts</option>
			                            <option value="10">10 - below Posts</option>
			                            <option value="15">15 - below Links</option>
			                            <option value="20">20 - below Pages</option>
			                            <option value="25">25 - below Comments</option>
			                            <option value="60">60 - below first separator</option>
			                            <option value="65">65 - below Plugins</option>
			                            <option value="70">70 - below Users</option>
			                            <option value="75">75 - below Tools</option>
			                            <option value="80">80 - below Settings</option>
			                            <option value="100">100 - below second separator</option>
			                        </select>
			                        <span class="help-block">Show post type in admin sidebar.</span>
			                    </div>
			                    <div class="form-group menu_icon">
			                        <label title="Admin Sidebar Icon.">Admin Sidebar Icon</label>
			                        <input type="text" class="form-control" name="menu_icon" value="" placeholder="i.e. dashicons-admin-post" />
			                        <span class="help-block">Post type icon. Use <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">dashicon</a> name or full icon URL (http://.../icon.png).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group show_in_admin_bar">
			                        <label title="Show in Admin Bar.">Show in Admin Bar</label>
			                        <select class="form-control" name="show_in_admin_bar" id="show_in_admin_bar">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in <a href="https://codex.wordpress.org/Toolbar" target="_blank">admin bar</a>.</span>
			                    </div>
			                    <div class="form-group show_in_nav_menus">
			                        <label title="Show in Navigation Menus.">Show in Navigation Menus</label>
			                        <select class="form-control" name="show_in_nav_menus" id="show_in_nav_menus">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in <a href="https://codex.wordpress.org/Navigation_Menus" target="_blank">Navigation Menus</a>.</span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_query" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group query_var">
			                        <label title="Query.">Query</label>
			                        <select class="form-control" name="query_var" id="query_var">
			                            <option selected="" value="false">Default (post type key)</option>
			                            <option value="true">Custom query variable</option>
			                        </select>
			                        <span class="help-block">
			                            Direct query variable used in <a href="https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters" target="_blank">WP_Query</a>. e.g. WP_Query( array(
			                            <strong>'post_type' =&gt; 'product'</strong>, 'term' =&gt; 'disk' ) )
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group publicly_queryable">
			                        <label title="Publicly Queryable.">Publicly Queryable</label>
			                        <select class="form-control" name="publicly_queryable" id="publicly_queryable">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Enable front end queries as part of parse_request().</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group custom_query_variable">
			                        <label title="Custom Query.">Custom Query</label>
			                        <input type="text" class="form-control" name="custom_query_variable" value="post_type" />
			                        <span class="help-block">Custom query variable.</span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_permalinks" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group rewrite">
			                        <label title="Permalink Rewrite.">Permalink Rewrite</label>
			                        <select class="form-control" name="rewrite" id="rewrite">
			                            <option value="false">No permalink (prevent URL rewriting)</option>
			                            <option selected="" value="true">Default permalink (post type key)</option>
			                            <option value="custom">Custom permalink</option>
			                        </select>
			                        <span class="help-block">
			                            Use Default <a href="https://codex.wordpress.org/Using_Permalinks" target="_blank">Permalinks</a> (using post type key), prevent automatic URL rewriting (no pretty permalinks), or set custom permalinks.
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group rewrite_slug">
			                        <label title="URL Slug.">URL Slug</label>
			                        <input type="text" class="form-control" name="rewrite_slug" value="post_type" disabled="disabled" />
			                        <span class="help-block">
			                            Pretty permalink base text. i.e.<br />
			                            www.example.com/product/
			                        </span>
			                    </div>
			                    <div class="form-group rewrite_with_front">
			                        <label title="Use URL Slug.">Use URL Slug</label>
			                        <select class="form-control" name="rewrite_with_front" id="rewrite_with_front" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Use Post Type slug as URL base.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group rewrite_pages">
			                        <label title="Pagination.">Pagination</label>
			                        <select class="form-control" name="rewrite_pages" id="rewrite_pages" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Allow post-type pagination.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                    <div class="form-group rewrite_feeds">
			                        <label title="Feeds.">Feeds</label>
			                        <select class="form-control" name="rewrite_feeds" id="rewrite_feeds" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Build feed permastruct.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_capabilities" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
			                <div class="field-group-col">
			                    <div class="form-group capabilities">
			                        <label title="Capabilities.">Capabilities</label>
			                        <select class="form-control" name="capabilities" id="capabilities" data-select2-current-value="base">
			                            <option selected="" value="base">Base capabilities</option>
			                            <option value="custom">Custom capabilities</option>
			                        </select>
			                        <span class="help-block">Set <a href="https://codex.wordpress.org/Roles_and_Capabilities" target="_blank">user capabilities</a> to manage post type.</span>
			                    </div>
			                    <div class="form-group capability_type">
			                        <label title="Base Capability Type.">Base Capability Type</label>
			                        <select class="form-control" name="capability_type" id="capability_type" data-select2-current-value="page">
			                            <option value="post">Posts</option>
			                            <option selected="" value="page">Pages</option>
			                        </select>
			                        <span class="help-block">Used as a base to construct capabilities.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group capabilities_read_post">
			                        <label title="Read Post.">Read Post</label>
			                        <input type="text" class="form-control" name="capabilities_read_post" value="read_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_read_private_posts">
			                        <label title="Read Private Posts.">Read Private Posts</label>
			                        <input type="text" class="form-control" name="capabilities_read_private_posts" value="read_private_posts" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_publish_posts">
			                        <label title="Publish Posts.">Publish Posts</label>
			                        <input type="text" class="form-control" name="capabilities_publish_posts" value="publish_posts" disabled="disabled" />
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group capabilities_delete_post">
			                        <label title="Delete Post.">Delete Post</label>
			                        <input type="text" class="form-control" name="capabilities_delete_post" value="delete_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_post">
			                        <label title="Edit Post.">Edit Post</label>
			                        <input type="text" class="form-control" name="capabilities_edit_post" value="edit_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_posts">
			                        <label title="Edit Posts.">Edit Posts</label>
			                        <input type="text" class="form-control" name="capabilities_edit_posts" value="edit_posts" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_others_posts">
			                        <label title="Edit Others Posts.">Edit Others Posts</label>
			                        <input type="text" class="form-control" name="capabilities_edit_others_posts" value="edit_others_posts" disabled="disabled" />
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="tab-pane  fade" id="tab_rest_api" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info">
							<div class="field-group-col">
								<div class="form-group show_in_rest">
									<label title="Show in Rest.">Show in Rest</label>
									<select name="show_in_rest" class="form-control" id="show_in_rest" data-select2-current-value="">
										<option selected="" value="">Choose...</option>
										<option value="true">Yes</option>
										<option value="false">No</option>
									</select>
									<span class="help-block">Whether to add the post type route in the REST API 'wp/v2' namespace.</span>
								</div>
							</div>

							<div class="field-group-col">
								<div class="form-group rest_base">
									<label title="Rest Base.">Rest Base</label>
									<input type="text" class="form-control" name="rest_base" value="">
									<span class="help-block">To change the base url of REST API route. Default is the post type key.</span>
								</div>
							</div>

							<div class="field-group-col">
								<div class="form-group rest_controller_class">
									<label title="Rest Controller Class.">Rest Controller Class</label>
									<input type="text" class="form-control" name="rest_controller_class" value="">
									<span class="help-block">REST API Controller class name. Default is 'WP_REST_Posts_Controller'.</span>
								</div>
							</div>
						</div>
					</div>
		        </div>
		    </div>
		    <div class="btn-box">
		        <input type="hidden" name="generator" value="post-type" />
                <input type="hidden" name="wpg-security" value="<?php echo wp_create_nonce()?>"/>
		        <button type="submit" class="btn btn-success" id="update-snippet" data-loading-text="Updating …">Update Code</button>
		    </div>
		</form>
	</div>

	<div class="section-code">
	<pre class="prettyprint">
	<?php 
	$type = isset($_GET['cpt']) ? $_GET['cpt'] : '';
	echo load_templates($type);
	?>
	</pre>
	</div>
	<?php
}


function load_templates($type) {
	if ($type=='testimonials') {
	$template = "
	function testimonial_post_type() {
		\$labels = array(
			'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Testimonials', 'text_domain' ),
			'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		\$args = array(
			'label'                 => __( 'Testimonial', 'text_domain' ),
			'description'           => __( 'Testimonial information page.', 'text_domain' ),
			'labels'                => \$labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            => array( 'category' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-page',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'testimonials', \$args );

	}
	add_action( 'init', 'testimonial_post_type', 0 );";
	} elseif ($type=='property') {
	$template = "
	function property_post_type() {
		\$labels = array(
			'name'                  => _x( 'Properties', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Property', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Properties', 'text_domain' ),
			'name_admin_bar'        => __( 'Property', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		\$args = array(
			'label'                 => __( 'Property', 'text_domain' ),
			'description'           => __( 'Properties information page.', 'text_domain' ),
			'labels'                => \$labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'page-attributes' ),
			'taxonomies'            => array( 'region', 'city' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'building',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'property', \$args );

	}
	add_action( 'init', 'property_post_type', 0 );";
	} elseif ($type=='team') {
	$template = "
	function team_member_post_type() {
		\$labels = array(
			'name'                  => _x( 'Team members', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Team member', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Team members', 'text_domain' ),
			'name_admin_bar'        => __( 'Team member', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		\$args = array(
			'label'                 => __( 'Team member', 'text_domain' ),
			'description'           => __( 'Team members information page.', 'text_domain' ),
			'labels'                => \$labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'page-attributes' ),
			'taxonomies'            => array( 'role', 'company' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-businessperson',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'team', \$args );

	}
	add_action( 'init', 'team_member_post_type', 0 );";
	} else {
	$template = "
	function custom_post_type() {
		\$labels = array(
			'name'                  => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Post Types', 'text_domain' ),
			'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		\$args = array(
			'label'                 => __( 'Post Type', 'text_domain' ),
			'description'           => __( 'Post Type Description', 'text_domain' ),
			'labels'                => \$labels,
			'supports'              => false,
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'post_type', \$args );

	}
	add_action( 'init', 'custom_post_type', 0 );";
	}

	return $template;
}