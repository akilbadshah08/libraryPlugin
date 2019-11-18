<table>
	<tr>
			<td>No</td>
			<td>Book Name</td>
			<td>Price</td>
			<td>Author</td>
			<td>Publisher</td>
			<td>Rating</td>
	</tr>
	
<?php 	
	while(have_posts()){
		$all_publishers=[];
		$all_authors=[];
		the_post();
		$publishers=wp_get_post_terms(get_the_ID(),'publishers');
		$authors=wp_get_post_terms(get_the_ID(),'authors');
		if(!empty($publishers)){
			foreach ($publishers as $key => $publisher) {
				$all_publishers[]=$publisher->name;
			}
		}

		if(!empty($authors)){
			foreach ($authors as $key => $author) {
				$all_authors[]=$author->name;
			}
		}
		echo '<tr>';	
		echo '<td>'.get_the_ID().'</td>';
		echo '<td>'.get_the_title().'</td>';
		echo '<td>'.get_post_meta(get_the_ID(),'price',true).'</td>';
		echo '<td>'.implode(',',$all_authors).'</td>';
		echo '<td>'.implode(',',$all_publishers).'</td>';
		echo '<td>'.get_post_meta(get_the_ID(),'rating',true).'</td>';
		echo '</tr>';
	}
 ?>
 </table>