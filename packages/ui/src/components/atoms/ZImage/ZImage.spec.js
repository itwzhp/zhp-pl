import { shallowMount } from "@vue/test-utils";
import ZImage from "./ZImage.vue";
describe("ZImage.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZImage);
    expect(component.contains(".z-image")).toBe(true);
  });
});
