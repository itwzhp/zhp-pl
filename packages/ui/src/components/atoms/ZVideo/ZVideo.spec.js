import { shallowMount } from "@vue/test-utils";
import ZVideo from "./ZVideo.vue";
describe("ZVideo.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZVideo);
    expect(component.contains(".z-video")).toBe(true);
  });
});
