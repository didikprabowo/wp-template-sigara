<?php
class Rich
{

    public function getArticle()
    {
        $data = [];
        if (have_posts()) {
            while (have_posts()) : the_post();
                $data["@context"] = "https://schema.org";
                $data["@type"]  = "NewsArticle";
                $data["mainEntityOfPage"]["@type"] = "WebPage";
                $data["mainEntityOfPage"]["@id"] = get_the_permalink();
                $data["headline"] = get_the_title();
                $data["image"] = get_the_post_thumbnail_url();
                $data["datePublished"] = get_the_date();
                $data["dateModified"] =  get_the_date();
                $data["author"]["@type"] = "";
                $data["author"]["name"] = get_the_author();
                $data["publisher"]["@type"] = "Organization";
                $data["publisher"]["name"] = get_bloginfo("name");
                $data["publisher"]["logo"]["@type"] = get_bloginfo("ImageObject");
                $data["publisher"]["logo"]["url"] = get_site_url();
                $data["description"] = get_the_excerpt();

            endwhile;
        }
        return json_encode($data);
    }

    public function getBreadcrumbList()
    {
        $data = [];
        if (have_posts()) {
            while (have_posts()) : the_post();
                $data["@context"] = "https://schema.org";
                $data["@type"]  = "BreadcrumbList";
                $data["itemListElement"]["@ListItem"]["@type"] = "ListItem";
                $data["itemListElement"]["@ListItem"]["name"] = get_the_title();
                $data["itemListElement"]["@ListItem"]["item"] = get_permalink();
            endwhile;
        }
        return json_encode($data);
    }

    public function getLogo()
    {
        $logo = [];
        $logo["@context"] = "https://schema.org";
        $logo["@type"] = "Organization";
        $logo["url"] = get_site_url();
        $logo["logo"] =  getLogo();

        return json_encode($logo);
    }

    public function getHome()
    {
        echo '<script type="application/ld+json">';
        echo $this->getLogo();
        if (is_single()) {
            echo $this->getArticle();
        }
        echo $this->getBreadcrumbList();
        echo '</script>';
    }
}
