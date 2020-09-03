import { shallowMount } from "@vue/test-utils";
import ZBubble from "./ZBubble.vue";
describe("ZBubble.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZBubble);
    expect(component.contains(".z-bubble")).toBe(true);
  });
});
