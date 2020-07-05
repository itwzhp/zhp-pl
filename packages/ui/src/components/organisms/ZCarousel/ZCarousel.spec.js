import { shallowMount } from "@vue/test-utils";
import ZCarousel from "./ZCarousel.vue";
describe("ZCarousel.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZCarousel);
    expect(component.contains(".z-carousel")).toBe(true);
  });
});
