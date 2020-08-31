import { shallowMount } from '@vue/test-utils';
import ZEvent from './ZEvent.vue';

describe('ZEvent.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZEvent);
    expect(component.contains('.z-event')).toBe(true);
  });
});
