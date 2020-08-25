import { shallowMount } from '@vue/test-utils';
import ZDropdown from './ZDropdown.vue';

describe('ZDropdown.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZDropdown);
    expect(component.contains('.z-dropdown')).toBe(true);
  });
});
