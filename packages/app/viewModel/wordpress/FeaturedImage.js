export default class FeaturedImage {
    constructor(rawData) {
        this.rawData = rawData;
    }

    get url() {
        return this.rawData.media_details.sizes.medium ? this.rawData.media_details.sizes.medium.source_url : this.rawData.media_details.sizes.full.source_url;
    }
}