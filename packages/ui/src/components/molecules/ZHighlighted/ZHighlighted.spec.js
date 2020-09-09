import { shallowMount } from "@vue/test-utils";
import ZHighlighted from "./ZHighlighted.vue";
describe("ZHighlighted.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZHighlighted);
    expect(component.get(".z-highlighted"));
  });
});
