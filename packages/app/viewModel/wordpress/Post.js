import FeaturedImage from "./FeaturedImage";

export default class Post {

    constructor(rawData) {
        this.rawData = rawData;
    }

    get hasFeaturedImage() {
        return (
            this.rawData.featured_image &&
            'wp:featuredmedia' in this.rawData._embedded &&
            this.rawData._embedded['wp:featuredmedia'].length > 0
        );
    }

    get featuredImage() {
        return new FeaturedImage(this.rawData._embedded['wp:featuredmedia'][0])
    }

}